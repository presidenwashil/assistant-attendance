#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>

const char* ssid = "Salmidi81"; // Ganti dengan SSID WiFi yang sesuai
const char* password = "Asdf1234"; // Ganti dengan password WiFi yang sesuai

String serverName = "http://192.168.1.3:8000/api/rfid"; // Ganti dengan IP server Laravel yang sesuai

#define RST_PIN D1
#define SDA_PIN D2
#define GREEN_LED_PIN D3 // Pin untuk LED Hijau
#define RED_LED_PIN D4   // Pin untuk LED Merah
#define BUZZER_PIN D8

MFRC522 mfrc522(SDA_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);
  pinMode(GREEN_LED_PIN, OUTPUT);
  pinMode(RED_LED_PIN, OUTPUT);
  pinMode(BUZZER_PIN, OUTPUT);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Put your card to the reader...");
  Serial.println(WiFi.localIP());
}

void loop() {
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  if (!mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  Serial.print("UID tag :");
  String content = "";

  for (byte i = 0; i < mfrc522.uid.size; i++) {
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }

  Serial.println();
  content.toUpperCase();

  HTTPClient http;
  WiFiClient client;

  http.begin(client, serverName);
  http.addHeader("Content-Type", "application/json");

  // Format data sebagai JSON
  String jsonData;
  StaticJsonDocument<200> doc;
  doc["rfid"] = content.substring(1);
  serializeJson(doc, jsonData);

  int httpCode = http.POST(jsonData);
  Serial.print("HTTP Response Code: ");
  Serial.println(httpCode);

  if (httpCode > 0) {
    if (httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      Serial.print("Server Response: ");
      Serial.println(payload);

      if (payload.indexOf("success") != -1) {
        digitalWrite(GREEN_LED_PIN, HIGH);
        delay(1000);
        digitalWrite(GREEN_LED_PIN, LOW);
        Serial.println("LED Hijau dinyalakan");
      } else {
        digitalWrite(RED_LED_PIN, HIGH);
        buzzBuzzer(1000, 1);
        delay(1000);
        digitalWrite(RED_LED_PIN, LOW);
        Serial.println("LED Merah dinyalakan");
      }
    } else {
      digitalWrite(RED_LED_PIN, HIGH);
      buzzBuzzer(1000, 1);
      delay(1000);
      digitalWrite(RED_LED_PIN, LOW);
      Serial.println("LED Merah dinyalakan");
    }
  } else {
    digitalWrite(RED_LED_PIN, HIGH);
    buzzBuzzer(1000, 3);
    delay(1000);
    digitalWrite(RED_LED_PIN, LOW);
    Serial.println("Gagal terhubung ke server");
  }

  http.end();
  delay(1000);
}

void buzzBuzzer(int delayTime, int repeatCount) {
  for (int i = 0; i < repeatCount; i++) {
    digitalWrite(BUZZER_PIN, HIGH);
    delay(delayTime);
    digitalWrite(BUZZER_PIN, LOW);
    delay(delayTime);
  }
}

<x-app-layout>
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
              $("#nokartu").load('/nokartu')
            },0);
        });
      </script>
    <form action="{{ route('assistant.store')}}" method="POST">
        @csrf
        <input type="text" class="form-control"  name="code" autocomplete="off" placeholder="Kode Aslab">
        <input type="text" class="form-control"  name="name" autocomplete="off" placeholder="Nama Aslab">
        <div id="nokartu"></div>
        <button type="submit">Simpan</button>
    </form>
</x-app-layout>

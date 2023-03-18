<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="bg-gradient-to-t from-gray-100 via-gray-100 to-gray-300">
    <div class="py-12">
            <div id="container" class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white border-2 border-gray-200 rounded-lg">
                <div class= "bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 gap-6 mt-6 mb-6 bg-white sm:grid-cols-1">
                    <div id="save_module" class="bg-white border border-gray-300 rounded-md overflow-hidden ml-2 mr-2">
                        <div class="p-4 bg-gray-100 border-b border-gray-300">
                            Add New Country
                        </div>
                        <form method="POST" action="">
                            @csrf
                        <ul id="saveform_errList"></ul>
                        <div id="success_message"></div>
                            <!--Name -->
                            <div class="pr-4 pl-4 mt-4 mb-4">
                                <x-label for="name" :value="__('Name')" />
                
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                            </div>
                
                            <!-- ISO -->
                            <div class="pr-4 pl-4 mt-4 mb-4">
                                <x-label for="iso" :value="__('ISO')" />
                
                                <x-input id="iso" class="block mt-1 w-full"
                                                type="text"
                                                name="iso"
                                                />
                            </div>
                            
                            <div class="flex items-center justify-end mt-8 bg-gray-100 border-t  border-gray-300">
                                <div class="p-3">
                                <x-button id="add_country" class="ml-4">
                                    {{ __('SAVE') }}
                                </x-button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div id="edit_module" class="bg-white border border-gray-300 rounded-md overflow-hidden ml-2 mr-2">
                        <div class="p-4 bg-gray-100 border-b border-gray-300">
                            Edit Country
                        </div>
                        <form method="POST" action="">
                            @csrf
                        <ul id="saveform_errList"></ul>
                        <div id="success_message_edit"></div>
                        <div id="success_message_update"></div>
                            <!--Name -->
                            <div class="pr-4 pl-4 mt-4 mb-4">
                                <x-label for="name" :value="__('Name')" />
                               
                                <x-input id="edit_name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                            </div>
                            <input id="country_id" type="hidden"  value ="">
                            <!-- ISO -->
                            <div class="pr-4 pl-4 mt-4 mb-4">
                                <x-label for="iso" :value="__('ISO')" />
                
                                <x-input id="edit_iso" class="block mt-1 w-full"
                                                type="text"
                                                name="iso"
                                                />
                            </div>
                            
                            <div class="flex items-center justify-end mt-8 bg-gray-100 border-t  border-gray-300">
                                <div class="p-3">
                                <x-button id="update_country" class="ml-4">
                                    {{ __('UPDATE') }}
                                </x-button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="lg:col-span-2 h-60 gap-6 sm:grid-cols-1">
                        <div id="table-data" class="bg-white border border-gray-300 rounded-md ml-2 mr-2">
                            <div class="p-4 space-x-20 bg-gray-100 border-b border-gray-300">
                                List of countries
                            </div>
                            <div class="flex flex-col mt-8 mb-8">
                                <div class="py-2">
                                    <div
                                        class="min-w-full">
                                        <table class="min-w-full">
                                            <thead>
                                                <tr>
                                                    <th class= "px-10 py-3 text-left text-gray-900 font-bold border-b border-gray-200 bg-gray-50">
                                                        #
                                                    </th>
                                                    <th class="px-6 py-3 text-left text-gray-900 font-bold border-b border-gray-200 bg-gray-50">
                                                        Name
                                                    </th>
                                                    <th class="px-6 py-3 text-left text-gray-900  font-bold border-b border-gray-200 bg-gray-50">
                                                        ISO
                                                    </th>
                                                    <th class="px-10 py-3 text-left text-gray-900 font-bold border-b border-gray-200 bg-gray-50">
                                                        Edit
                                                    </th>
                                                </tr>
                                            </thead>
                    
                                            <tbody class="bg-white">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>  
    </div>
</div>
</x-app-layout>
<script>
     $(document).ready(function(){
        $('#save_module').show();
        $('#edit_module').hide();
        fetchCountreis();

        function fetchCountreis()
        {
           $.ajax({
            type: "GET",
            url: "/fetch-countries",
            dataType: "json",
            success: function (response) {
                $('tbody').html('');
                $.each(response.countries, function (key, item) { 
                    $('tbody').append('<tr><td class="px-6 py-4  border-b border-gray-200"><div class="flex items-center"><div class="ml-4"><div class="text-sm font-bold text-gray-900">'+item.id+'</div></div></div></td><td class="px-6 py-4 border-b border-gray-200"><div class="text-sm text-gray-900">'+item.name+'</div></td><td class="px-6 py-4 border-b border-gray-200"><div class="text-sm text-gray-900">'+item.iso+'</div></td><td class="px-6 py-4 border-b border-gray-200"><button wire:click="" class="px-4 py-2 text-white bg-blue-600 rounded-md" id="edit_country" value="'+item.id+'">Edit</button></td></tr>');
                });
                var contentHeight = $('#table-data').height();
                $('#container').height(contentHeight+140);
            }
           });
           
        }

        $(document).on('click', '#edit_country', function (event) {
            event.preventDefault();
            var country_id = $(this).val();
            $('#country_id').val(country_id);
            $('#save_module').hide();
            $('#edit_module').show();
            $.ajax({
                type: "GET",
                url: "/edit-country/"+country_id,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400)
                    {
                        $("#success_message_edit").html('');
                        $("#success_message_edit").addClass('bg-red-100 p-4');
                        $("#success_message_edit").text(response.message);
                    }else{
                        $("#edit_name").val(response.country.name);
                        $("#edit_iso").val(response.country.iso);
                    }
                }
            });
        });
       
        $(document).on('click', '#update_country', function(event){
            event.preventDefault();
            var country_id = $("#country_id").val();
           
            var  data ={
                'name' : $("#edit_name").val() ,
                'iso' : $("#edit_iso").val() ,
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            type: "PUT",
            url: "/update-country/"+country_id,
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status ==400){
                   $('#saveform_errList').html('');
                   $('#saveform_errList').addClass('bg-red-100 p-4');
                    $.each(response.errors, function(key, err_values) { 
                        $('#saveform_errList').append('<li>'+err_values+'</li>');
                    });
                }else{
                    $('#saveform_errList').html('');
                    $('#success_message_update').addClass('bg-green-100 p-4');
                    $('#success_message_update').text(response.message);
                    setTimeout(function() {
                        $('#success_message').text('');
                        $('#success_message').removeClass('bg-green-100 p-4');
                        $('#save_module').show();
                        $('#edit_module').hide();
                    }, 1000);
                    $('#name').val('');
                    $('#iso').val('');
                    fetchCountreis();
                }
            }
          });
        });

        $(document).on('click', '#add_country', function(event){
            event.preventDefault();
            var data = {
                'name': $('#name').val(),
                'iso': $('#iso').val(),
            }
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          $.ajax({
            type: "POST",
            url: "/dashboard",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status ==400){
                   $('#saveform_errList').html('');
                   $('#saveform_errList').addClass('bg-red-100 p-4');
                    $.each(response.errors, function(key, err_values) { 
                        $('#saveform_errList').append('<li>'+err_values+'</li>');
                    });
                }else{
                    $('#saveform_errList').html('');
                    $('#success_message').addClass('bg-green-100 p-4');
                    $('#success_message').text(response.message);
                    setTimeout(function() {
                        $('#success_message').text('');
                        $('#success_message').removeClass('bg-green-100 p-4');
                    }, 1000);
                    $('#name').val('');
                    $('#iso').val('');
                    fetchCountreis();
                }
            }
          });
        });
     });


</script>

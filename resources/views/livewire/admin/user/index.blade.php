<div>
    <x-table 
        :$headers 
        :$rows 
        filter 
        loading 
        paginate 
        :quantity="[5,10,20,50,100]" 
        link="user/{id}" >

        @interact('column_information.gender',$row)
            <x-icon :name="$row['information']['gender'] == 'M' ? 'fas.person' : 'fas.person-dress' " :color="$row['information']['gender'] == 'M' ? 'blue' : 'fuchsia' " class="size-5" />
        @endinteract
        
        @interact('column_deleted_at',$row)
            <x-badge :text="$row['deleted_at'] ? 'Inactive' : 'Active'" :color="$row['deleted_at'] ? 'red' : 'green'" round />
        @endinteract
    </x-table>
</div>

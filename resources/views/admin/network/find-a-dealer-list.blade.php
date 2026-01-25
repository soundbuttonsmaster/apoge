<div class="col-12">
    <h2 class="text-center text-2xl font-bold mb-4">Dealers List</h2>
    <div class="overflow-x-auto"> <!-- Horizontal Scroll Wrapper -->
        <table class="bg-white border border-gray-200"> <!-- min-width set kiya -->
            <thead class="bg-gray-800">
                <tr>
                    <th class="py-2 px-4 border" style="width: 10px;">#</th>
                    <th class="py-2 px-4 border" style="width: 280px;">Name </th>
                     <th class="py-2 px-4 border" style="width: 280px;">Email </th>
                     <th class="py-2 px-4 border" style="width: 280px;">Phone </th>
                    {{-- <th class="py-2 px-4 border">Company</th> --}}
                    <th class="py-2 px-4 border" style="width: 150px;">State</th>
                    <th class="py-2 px-4 border" style="width: 200px;">District</th>
                    <th class="py-2 px-4 border" style="width: 350px;">Location</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($dealers))
                    @foreach ($dealers as $key => $item)
                    <tr class="border-b">
                        <td class="py-2 px-4 border">{{ $key + 1 }}</td>
                        {{-- <td class="py-2 px-4 border">
                            <div> {{ $item->name }}</div><br/>
                            <div><i class="far fa-envelope"></i> {{ $item->email }}</div><br/>
                            <div><i class="fas fa-mobile-alt"></i> {{ $item->phone }}</div>
                        </td> --}}
                        <td class="py-2 px-4 border">{{ $item->name }}</td>
                        <td class="py-2 px-4 border">{{ $item->email }}</td>
                            <td class="py-2 px-4 border">{{ $item->phone }}</td>
                        {{-- <td class="py-2 px-4 border">XYZ Pvt Ltd</td> --}}
                        <td class="py-2 px-4 border">{{ $item->state }}</td>
                        <td class="py-2 px-4 border">{{ $item->district }}</td>
                        <td class="py-2 px-4 border">{{ $item->location }}</td>
                    </tr>  
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

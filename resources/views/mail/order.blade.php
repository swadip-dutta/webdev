<table class="table table-bordered">
  <thead>
    <tr>
      <th style="border: 1px solid rgb(50, 204, 20); width:10%" scope="col">#SL</th> 
      <th style="border: 1px solid rgb(50, 204, 20); width:50%" scope="col">Product Name</th> 
      <th style="border: 1px solid rgb(50, 204, 20); width:20%" scope="col">Image</th> 
      <th style="border: 1px solid rgb(50, 204, 20); width:10%" scope="col">Quantity</th>
      <th style="border: 1px solid rgb(50, 204, 20); width:10%" scope="col">Price</th>
    </tr>
  </thead>
  <tbody>

    @php
        $total = 0;
    @endphp

   @foreach($data as $item)
        <tr>
          <td style="border: 1px solid rgb(225, 0, 255); width:10%">{{ $loop->index + 1 }}</td>   
          <td style="border: 1px solid rgb(225, 0, 255); width:50%">{{ $item->product->title }}</td>   
          <td style="border: 1px solid rgb(225, 0, 255); width:20%"><img src="{{ asset('images/'.$item->product->thumbnail) }}" alt=""></td>   
          <td style="border: 1px solid rgb(225, 0, 255); width:10%">{{ $item->quantity }}</td>
          <td style="border: 1px solid rgb(225, 0, 255); width:10%">{{ $item->product_unit_price }}</td>
          @php
           $total += $item->quantity * $item->product_unit_price;
          @endphp
        </tr>
    @endforeach
       

       <span style="float: right">{{ $total }}</span>

  </tbody>
</table>
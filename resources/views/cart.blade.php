@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="success" style="display: none" class="col-md-8 text-center h3 p-4 bg-success text-light rounded">تمت عملية الشراء بنجاح</div>
            @if (session('message'))
            <div class="col-md-8 text-center h3 p-4 bg-success text-light rounded">تمت عملية الشراء بنجاح</div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">عربة التسوق</div>
                    <div class="card-body">
                        @if ($items->count())
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">السعر</th>
                                        <th scope="col">الكمية</th>
                                        <th scope="col">السعر الكلي</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                @php($totalPrice = 0)
                                @foreach ($items as $item)
                                    @php($totalPrice += ($item->price * $item->pivot->number_of_copies))
                                    <tbody>
                                        <tr>
                                            <th>{{$item->title}} </th>
                                            <td>{{$item->price}} $</td>
                                            <td>{{$item->pivot->number_of_copies}}</td>
                                            <td>{{$item->price * $item->pivot->number_of_copies}} $</td>
                                            <td>
                                                <form action="{{route('cart.remove_all',$item->id)}}" style="float:left;margin:auto 5px;" method="POST">
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-sm" type="submit">ازل الكل</button>
                                                </form>
                                                <form action="{{route('cart.remove_one',$item->id)}}" method="post"  style="float:left;margin:auto 5px;">
                                                    @csrf
                                                    <button class="btn btn-outline-warning btn-sm" type="submit">ازل واحدا</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <h4 class="mb-5">المجموع النهائي : {{$totalPrice}}</h4>
                            <div id="paypal-button-container" class="d-inline-block"></div>
                            <a href="{{ route('credit.checkout')}}" class="d-inline-block mb-4 float-start btn bg-cart" style="text-decoration: none;">
                                <span>البطاقة الائتمانية</span>
                                <i class="fas fa-credit-card"></i>
                            </a>
                        @else
                        <div class="alert alert-info text-center">
                            لا يوجد كتب في العربة
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://www.paypal.com/sdk/js?client-id=AXLs6iFhklSn9Sq9Li1zzBjczWRew4EnlKKxMicFVh4Ue3991j_xH4uI6QnxxH3dyni51sRVjOAWx2nM&currency=USD"></script>
<script>
    paypal.Buttons({
      //Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
       return fetch('/api/paypal/create-payment' , {
        method:'POST',
        body:JSON.stringify({
            'userId' : "{{auth()->user()->id}}",
        })
       }).then(function(res){
            return res.json();
       }).then(function(orderData){
            return orderData.id;
       })
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
       return fetch('/api/paypal/execute-payment',{
        method:'POST',
        body:JSON.stringify({
            orderId : data.orderID,
            userId : "{{auth()->user()->id}}",
        })
       }).then(function(res)
       {
        return res.json();
       }).then(function(orderData)
       {
            $('#success').slideDown(200) ;
            $('.card-body').slideUp(0);
       })
      }
    }).render('#paypal-button-container');
  </script>
@endsection

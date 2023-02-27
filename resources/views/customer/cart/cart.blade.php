@extends('customer.layout.index')

@section('title','Cart')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid" id="orderPage" style="display: inline">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-dark table-borderless table-hover text-center mb-0">
                        <thead class="thead-white">
                            <tr>
                                <th></th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="tableData">

                            @foreach ($cart as $c)
                            <tr>
                                <input type="hidden" id="cartId" value="{{$c->id}}">
                                <input type="hidden" id="price" value="{{$c->product_price}}">
                                <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                                <input type="hidden" id="productId" value="{{$c->product_id}}">
                                <td class="align-middle"><img src="{{asset('storage/'.$c->product_image)}}" class=" img-thumbnail shadow-sm w-50" alt=""></td>
                                <td class="align-middle"><a class="" href="{{route('customer#viewProduct',$c->product_id)}}">{{$c->product_name}}</a></td>
                                <td class="align-middle">{{$c->product_price}} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 110px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-success btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" min="0" class="form-control form-control-sm border-0 count" disabled id='count' value="{{$c->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-success btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{$c->product_price*$c->qty}} MMK</td>
                                <input type="hidden" id="total_hidden" class="total_hidden" value="{{$c->product_price*$c->qty}}">
                                <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4 text-white">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart Summary</span></h5>
                    <div class=" p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="totalPrice">{{$total}} MMK</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 MMK</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{$total+3000}} MMK</h5>
                            </div>
                            <button class="btn btn-block btn-success font-weight-bold my-3" id="order">Order</button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 removeAll" id="removeAll">Delete Cart</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="container-fluid" id="verifyPage" style="display: none">
        <div class="col-lg-6 offset-lg-3">
            <div class="card bg-black">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Password Verify</h3>
                    </div>
                    <hr>
                    @if (session('failPass'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i>{{session('failPass')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form>
                        @csrf
                        <div>
                            <div class="form-group">
                            <label class="control-label mb-1">Enter Password</label>
                            <input id="cc-pament passwordInput password" name="password" type="password" class="passwordInput password form-control @error('password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter password...">
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div>
                            <input type="checkbox" id="show_password_status" class="m-2 show_password_status">Show Password
                        </div>

                        <div class="my-3 offset-10">
                            <input type="button" class="btn btn-success" id="verify" value="Verify">
                        </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
@section('script')
    <script>
    $(document).ready(function(){
            $('.btn-minus').click(function(){
                $parents=$(this).parents('tr');
                $count=$parents.find('.count');
                if ($count.val()!=1) {
                    $count.val(Number($count.val())-1)
                    ItemTotalPrice()
                }
            });

            $('.btn-plus').click(function(){
                $parents=$(this).parents('tr');
                $count=$parents.find('.count');
                $count.val(Number($count.val())+1)
                ItemTotalPrice()
            });

            $('.remove').click(function(){
                if (confirm('Are you sure to delete this cart ?')) {
                    $parents=$(this).parents('tr');
                    $cart_id=$parents.find('#cartId').val();
                    $parents.remove();
                    $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/customer/cart/remove',
                        dataType:'json',
                        data:{'cart_id':$cart_id}
                    })
                    finalPrice();
                }

            })

            $('.removeAll').click(function(){
                if (confirm('Are you sure to delete all of your cart?')) {
                    $('#tableData').remove();
                    $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/customer/cart/removeAll',
                        dataType:'json',
                    })
                    finalPrice();
                }
            })

            $('#order').click(function(){
                $('#orderPage').hide();
                $('#verifyPage').show();

            })

            $('#verify').click(function(){
                $parents=$('#tableData tr');
                if ($parents.length!=0) {
                        $password=$('.password').val();
                        $data=[];
                        $data['password']=$password;
                        $order_id=`OID-${Math.floor(Math.random()*1000001)}`;
                        $('#tableData tr').each(function(index,row){
                            $data.push({
                                'user_id': $(row).find('#userId').val(),
                                'product_id':$(row).find('#productId').val(),
                                'qty':$(row).find('#count').val(),
                                'total':$(row).find('#total_hidden').val(),
                                'order_id':$order_id,
                            })
                        })
                            $.ajax({
                            type:'get',
                            url:'http://127.0.0.1:8000/customer/order/add',
                            dataType:'json',
                            data:Object.assign({},$data),
                            success:function(data){
                                if (data.status=='true') {
                                    window.location.href='http://127.0.0.1:8000/customer/home';
                                }else{
                                    alert('Wrong Password.....');
                                }
                            }
                        })
                }else{
                    alert('There is no product in your cart.')
                }


            })

            $('#show_password_status').click(function (){
                let input = document.getElementsByClassName('passwordInput')[0];
                if (input.type === "password") {
                    input.type = "text";
                } else {
                    input.type = "password";
                }
            })

            function ItemTotalPrice(){
                $price=$parents.find('#price').val();
                $ItemTotalPrice=Number($price)*Number($count.val());
                $ItemTotal=$parents.find('#total');
                $ItemTotal.html(`${$ItemTotalPrice} MMK`)
                $parents.find('.total_hidden').val($ItemTotalPrice);
                finalPrice()
            }

            function finalPrice() {
                $totalPrice=0
                $('#tableData tr').each(function(index,row){
                    $totalPrice+=Number($(row).find('.total_hidden').val());
                })
                $('#totalPrice').html(`${$totalPrice} MMK`);
                $('#finalPrice').html(`${$totalPrice+3000} MMK`);
            }
        })
    </script>
@endsection

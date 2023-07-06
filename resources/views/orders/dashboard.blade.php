@include('inc.navbar')

<div class="main-container">
    <h1>Orders </h1>
    <br>
    @if (session('success'))
        @include('partials._success')
    @elseif (session('error'))
        @include('partials._error')
    @endif

    @if ($orders->isEmpty())
        <br>
        <p style="font-weight: bold; font-size: 20px; text-align: center;" class="text-danger">You have no orders to display!</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Amount</th>
                    <th>Shipping Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Tracking Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->orderShipName }}</td>
                        <td>{{ $order->orderAmount }}</td>
                        <td>{{ $order->orderShipAddress }}</td>
                        <td>{{ $order->orderCity }}</td>
                        <td>{{ $order->orderState }}</td>
                        <td>{{ $order->orderZip }}</td>
                        <td>{{ $order->orderCountry }}</td>
                        <td>{{ $order->orderPhone }}</td>
                        <td>{{ $order->orderEmail }}</td>
                        <td>{{ $order->orderDate }}</td>
                        <td>{{ $order->orderStatus }}</td>
                        <td>{{ $order->orderTrackingNumber }}</td>
                        <td>
                            <div class="d-flex">
                                <!-- <a href="" type="button" class="btn btn-warning">Details</a> -->
                                <!-- <a href="" type="button" class="btn btn-primary">Edit</a> -->
                                <!-- <a href="" type="button" class="btn btn-danger">Archive</a> -->
                                <a href="{{ route('sendEmail', $order->order_id) }}" type="button" class="btn btn-info">Send Email</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

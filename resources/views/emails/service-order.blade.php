<?php
/*
$shipping_details = "<br>";
$totalAmt = 0;
$paidAmt = 0;
$dueAmt = 0;
if ($order != null) {
	$shipping_details .= ($order->full_name ?? '') . '<br>';
	$shipping_details .= ($order->email ?? '') . '<br>';
	$shipping_details .= ($order->phone_no ?? '') . '<br>';
	$shipping_details .= ($order->street_address ?? '') . ', ' . ($order->street_number ?? '') . ', ' . ($order->city ?? '') . ',' . '<br>';
}
?>
@component('mail::message')
<table cellspacing="0" cellpadding="5">
	<tbody>
		<tr valign="top">
			<td>{{translate('Order No')}}: {{$order->id}}</td>
			<td>{{translate('Order Date')}}:<br> {{$order->booking_date}}</td>
		</tr>
		<tr valign="top">
			<td><b>{{translate('Shipping address')}}</b>: {!!$shipping_details!!}</td>
		</tr>
	</tbody>
</table>
<table border="1" cellspacing="0" cellpadding="5">
	<thead>
		<tr>
			<th>{{translate('SL')}}</th>
			<th>{{translate('Booking No')}}</th>
			<th>{{translate('Item')}}</th>
			<th>{{translate('Date & Time')}}</th>
			<th>{{translate('Price')}}</th>
			<th>{{translate('Paid')}}</th>
			<th>{{translate('Due')}}</th>
			< </tr>
	</thead>
	<tbody>
		@foreach ($order->order_details as $key => $details)
		<?php
		$totalAmt=$totalAmt+$details->service_amount;
		$paidAmt=$paidAmt+$details->paid_amount;
		$dueAmt=$dueAmt+$details->due;
		?>
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$details->id}}</td>
			<td>{{$details->service}}</td>
			<td>{{$details->date .' '. $details->start_time.' to '.$details->end_time }}</td>
			<td>{{$details->service_amount }}</td>
			<td>{{$details->paid_amount }}</td>
			<td>{{$details->due }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div style="width: 100;float: right;">
	<b style="float:right;">{{translate('Total Amount')}}: {{round($totalAmt,2)}}</b><br>
	<b style="float:right;">{{translate('Discount')}}: {{round($order->coupon_discount,2)}}</b><br>
	<b style="float:right;">{{translate('Payable Amount')}}: {{round($totalAmt-$order->coupon_discount,2)}}</b><br>
	<b style="float:right;">{{translate('Paid Amount')}}: {{round($paidAmt,2)}}</b><br>
	<b style="float:right;">{{translate('Due Amount')}}: {{round((($totalAmt-$order->coupon_discount)-$paidAmt),2)}}</b>
</div>
 */
 ?>
@component('mail::message')
<p style="text-align: center;"><strong><span style="font-size: 20px;">Bienvenido a &nbsp;Facil Vet</span></strong></p>
<p>Su cita ha sido agendada con el detalle a continuacion</p>
<p><br></p>

		@foreach ($order->order_details as $key => $details)
	
			Inicio
			{{$details->start_time}}<br>
			Fin
			{{$details->end_time }}<br>
			Nombre Cliente 
			{{$order->full_name}}<br>
			Email
			{{$order->email}}<br>
			Telefono
			{{$order->phone_no}}<br>
	
		@endforeach

<p>Le recomendamos llegar 20 minutos antes de la cita para no tener problemas de ingreso.</p>
<p>puede acceder a su area de cliente con el boton a continuacion.</p><br>
<button type="button" class="btn btn-success">Acceder area Cliente</button><br>
<p>Que tenga buen dia.</p>


@endcomponent
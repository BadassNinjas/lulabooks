@extends('beautymail::templates.widgets')

@section('content')
    <img src ="http://i.imgur.com/A24y5rI.png" alt="logo" /><br><br><br>

    @include('beautymail::templates.widgets.newfeatureStart')

        <h4 class="secondary"><strong>Hello {{ $user->billing_detail->firstname }}</strong></h4>
        <p>This email serves to confirm the order you have placed on our website. </p>
        <p>Please find below how our shipping schedule works.</p>
        <ul>
          <li>For all new items including all stationery, we deliver to you withing a maximum of four days from the time of purchase</li>
          <li>For second hand items such as A-GRADE and B-GRADE Books, We deliver your order within 24 - 48 hours</li>
        </ul>


    @include('beautymail::templates.widgets.newfeatureEnd')

@stop

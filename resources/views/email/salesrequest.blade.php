@extends('beautymail::templates.widgets')

@section('content')
    <img src ="http://i.imgur.com/A24y5rI.png" alt="logo" /><br><br><br>

    @include('beautymail::templates.widgets.newfeatureStart')

        <h4 class="secondary"><strong>Hello {{ $name }}</strong></h4>
        <p>Thank you for filling out our sales request form</p>
        <p>A sales Representitive will be in touch with you shortly to perform a quality control check for your book</p>
        <p>This is a neccessary process to protect both buyers and sellers</p>
        <p>For more information on how our process works please click on the link below</p>
         @include('beautymail::templates.minty.button', ['text' => 'How it works', 'link' => 'https://lulabooks.mobi/faq'])


    @include('beautymail::templates.widgets.newfeatureEnd')

@stop

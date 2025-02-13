<h1>New Product Created</h1>

<p>A new product has been created:</p>

<p><strong>Name:</strong> {{ $product->title }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>
<p><strong>Price:</strong> {{ $product->price }}</p>

<p>View the product: <a href="{{ route('user.dashboard.show', $product->id) }}">Link</a> (Adjust route as needed)</p>


<style>
    body, body *:not(html):not(style):not(br):not(tr):not(code) {
    font-family: Avenir, Helvetica, sans-serif;
    box-sizing: border-box;
}

body {
    background-color: #449273;
    color: #74787e;
    height: 100%;
    hyphens: auto;
    line-height: 1.4;
    margin: 0;
    -moz-hyphens: auto;
    -ms-word-break: break-all;
    width: 100% !important;
    -webkit-hyphens: auto;
    -webkit-text-size-adjust: none;
    word-break: break-all;
    word-break: break-word;
}

p,
ul,
ol,
blockquote {
    line-height: 1.4;
    text-align: left;
}

a {
    color: #3869d4;
}

a img {
    border: none;
}

/* Typography */

h1 {
    color: #2F3133;
    font-size: 19px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h2 {
    color: #2F3133;
    font-size: 16px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h3 {
    color: #2F3133;
    font-size: 14px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

p {
    color: #74787e;
    font-size: 16px;
    line-height: 1.5em;
    margin-top: 0;
    text-align: left;
}

p.sub {
    font-size: 12px;
}

img {
    max-width: 100%;
}

/* Layout */

.wrapper {
    background-color: #449273;
    margin: 0;
    padding: 0;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

.content {
    margin: 0;
    padding: 0;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

/* Header */

.header {
    padding: 25px 0;
    text-align: center;
}

.header a {
    color: #bbbfc3;
    font-size: 19px;
    font-weight: bold;
    text-decoration: none;
    text-shadow: 0 1px 0 #ffffff;
}

/* Body */

.body {
    background-color: #ffffff;
    border-bottom: 1px solid #ffffff;
    border-top: 1px solid #ffffff;
    margin: 0;
    padding: 0;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

.inner-body {
    background-color: #ffffff;
    margin: 0 auto;
    padding: 0;
    width: 570px;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 570px;
}

/* Subcopy */

.subcopy {
    border-top: 1px solid #edeff2;
    margin-top: 25px;
    padding-top: 25px;
}

.subcopy p {
    font-size: 12px;
}

/* Footer */

.footer {
    margin: 0 auto;
    padding: 0;
    text-align: center;
    width: 570px;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 570px;
}

.footer p {
    color: #aeaeae;
    font-size: 12px;
    text-align: center;
}

/* Tables */

.table table {
    margin: 30px auto;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

.table th {
    color: #74787e;
    border-bottom: 1px solid #edeff2;
    padding-bottom: 8px;
}

.table td {
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    padding: 10px 0;
}

.content-cell {
    padding: 35px;
}

/* Buttons */

.action {
    margin: 30px auto;
    padding: 0;
    text-align: center;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

.button {
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
    color: #ffffff;
    display: inline-block;
    text-decoration: none;
    -webkit-text-size-adjust: none;
}

.button-blue, .button-primary {
    background-color: #00a3ff;
    border-top: 10px solid #00a3ff;
    border-right: 18px solid #00a3ff;
    border-bottom: 10px solid #00a3ff;
    border-left: 18px solid #00a3ff;
}

.button-green, .button-success {
    background-color: #2ab27b;
    border-top: 10px solid #2ab27b;
    border-right: 18px solid #2ab27b;
    border-bottom: 10px solid #2ab27b;
    border-left: 18px solid #2ab27b;
}

.button-red, .button-error {
    background-color: #bf5329;
    border-top: 10px solid #bf5329;
    border-right: 18px solid #bf5329;
    border-bottom: 10px solid #bf5329;
    border-left: 18px solid #bf5329;
}

/* Panels */

.panel {
    margin: 0 0 21px;
}

.panel-content {
    background-color: #ffffff;
    padding: 16px;
}

.panel-item {
    padding: 0;
}

.panel-item p:last-of-type {
    margin-bottom: 0;
    padding-bottom: 0;
}

/* Promotions */

.promotion {
    background-color: #FFFFFF;
    border: 2px dashed #9BA2AB;
    margin: 0;
    margin-bottom: 25px;
    margin-top: 25px;
    padding: 24px;
    width: 100%;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
}

.promotion h1 {
    text-align: center;
}

.promotion p {
    font-size: 15px;
    text-align: center;
}




</style>
{{-- <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">Heading 1</h1>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">This is a paragraph filled with Lorem Ipsum and a link. Cumque dicta <a href="" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #3869d4;">doloremque eaque</a>, enim error laboriosam pariatur possimus tenetur veritatis voluptas.</p> --}}
<h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 16px; font-weight: bold; margin-top: 0; text-align: left;">Hello !! &nbsp; </h2>
<div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
<table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
<thead style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
<tr>
<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">Product</th>
<th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px; text-align: right;">Price</th>
</tr>
</thead>
<tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
 
<tr>

<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ !empty($product->title) ?  $product->title  : '' }}</td>
<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0; text-align: right;">₱ {{ (!empty($product->price)) ? $product->price : '' }}</td>
</tr>


</tbody>
<tfoot>
   <tr>
    <td></td>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0; text-align: right;">total : ₱ {{ (!empty($product->price)) ? $product->price : '' }}.00</td>
   </tr>
</tfoot>
</table>
</div>


<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> Title :  {{ (!empty($product->title)) ? $product->title : '' }}</p>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> Description :  {{ (!empty($product->description)) ? $product->description : '' }} </p>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> Stock :   {{ (!empty($product->stock)) ? $product->stock : '' }}</p>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> Date Of Appointment :    {{ date('M d, Y', strtotime($product->created_at)) }} </p>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> <p>View the product: <a href="{{ route('user.dashboard.show', $product->id) }}">Link</a> (Adjust route as needed)</p></p>






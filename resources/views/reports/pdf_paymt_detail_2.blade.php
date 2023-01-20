<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1.5cm;
                font-size:15;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1.0cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1.0cm;
            }
        </style>


<style type="text/css"> 
    table{
        width: 100%;
        border-collapse: collapse;
    } 
    table td, table th{  
        /* border:1px solid black; */
        text-align: left;
    } 
    table tr, table td{
        padding: 5px;
        font-size:9;
    } 
</style>

    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
           
            -- Donations/Nsawa Received--
           
            {{config('app.cname')}}
        </header>

        <footer>
        Copyright {{config('app.name')}}: &copy; <?php echo date("Y");?> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
    <main>
    <!-- @if(!empty($insco_name))
    PAYMENT TO:   {{$insco_name}} <br>
    @endif

    Date Range:  from {{date('j F, Y', strtotime($sdate))}} to  {{date('j F, Y', strtotime($edate))}} -->
    <div class="container"> 
    <br/>  
        
        <table>  
        <tr>
       
        <th>ID</th>
        <th>Date</th>
        <!-- <th>Deceased Name</th> -->
        <th>Family</th>
        <th>Donor Name</th>
        <th>Beneficiary</th>
        <th>Phone</th>
        <th>Amount</th>                               
        </tr> 

            <tbody>
            @foreach ($payments as $paymt)
    
    <tr>
        
    @if (count($payments) > 0)
@foreach ($payments as $paymt)
<tr>
<td> {{$paymt->pkid}}</td>
<td> {{ date('d-M-y', strtotime($paymt->created_at)) }}</td>

<!-- <td> {{$paymt->dead->d_name?? "n/a"}}</td> -->
<td>{{$paymt->dead->family->fam_name}}</td>
<td> {{$paymt->donor_name}}</td>

<td> {{$paymt->beneficiary->ben_type?? "n/a"}}</td>
<td> {{$paymt->donor_phone}}</td>
<td> {{number_format($paymt->amt,2)}}</td>
</tr>
@endforeach
@else
<tr>
<td colspan="3" align="center">
No donations/nsawa Found.
</td>
</tr>
@endif
    </tr>
   
    @endforeach
</tbody>
        </table>  
    </div>  
        </main>

    </body>
</html>

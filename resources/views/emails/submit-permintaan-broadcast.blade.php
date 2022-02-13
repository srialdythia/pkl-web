<h1>[PLEASE PROCESS THIS CERTIFICATION REQUEST]</h1>
<table>
    <tr>
        <td>Number</td> 
        <td>{{ $emailContent['application_no'] }}</td>
    </tr>
    <tr>
        <td>Name Of Requestor</td> 
        <td>{{ $emailContent['requestor_name'] }}</td>
    </tr>
    <tr>
        <td>Application Type</td> 
        <td>{{ $emailContent['application_type'] }}</td>
    </tr>
    <tr>
        <td>Product Type</td> 
        <td>{{ $emailContent['product_type'] }}</td>
    </tr>
    <tr>
        <td>Type</td> 
        <td>{{ $emailContent['type'] }}</td>
    </tr>
    <tr>
        <td>Detail Specification</td>
        <td> 
            @foreach ( $emailContent['detail_specification'] as $detail)
                <p>{{ $detail->product_no }}</p>
            @endforeach
        </td>
    </tr>
    <tr>
        <td>URL</td>
        <td><a href="{{ $emailContent['url'] }}">{{ $emailContent['url'] }}</a></td>
    </tr>
</table>
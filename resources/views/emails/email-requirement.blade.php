<h1>Tampilan email Penerima</h1>
<table>
    <tr>
        <td>Number</td>
        <td>{{ $emailContent['application']->application_no }}</td>
    </tr>
    <tr>
        <td>Name Of Requestor</td>
        <td>{{ $emailContent['application']->requestor_name }}</td>
    </tr>
    <tr>
        <td>Application Type</td>
        <td>{{ $emailContent['application']->appType->name }}</td>
    </tr>
    <tr>
        <td>Product Type</td>
        <td>{{ $emailContent['application']->productType->name }}</td>
    </tr>
    <tr>
        <td>Type</td>
        <td>{{ $emailContent['application']->productTypeCategory->name }}</td>
    </tr>
    <tr>
        <td>Detail Specification</td>
        <td>
            @foreach ($emailContent['application']->products as $product )
            <p>-{{ $product->product_no }}</p>    
            @endforeach
        </td>
    </tr>
    <tr>
        <td>Requirement Documnet</td>
        <td>{{ $emailContent['document']}}</td>
    </tr>
    <tr>
        <td>Business Unit</td>
        <td>{{ $emailContent['businessUnit'] }}</td>
    </tr>
    <tr>
        <td>Due Date</td>
        <td>{{ $emailContent['dueDateDocument'] }}</td>
    </tr>
</table>
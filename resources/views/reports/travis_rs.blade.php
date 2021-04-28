<table>
    <thead style="font-weight:bold;">
        <tr>
            <th width="30">Customer</th>
            <th width="100">Address</th>
            <th width="30">Unit Model</th>
            <th width="30">CS No.</th>
            <th width="30">Engine</th>
            <th width="30">VIN</th>
            <th width="30">Dealer Name</th>
            <th width="30">Delivery Date</th>
            <th width="30">Production Date</th>
            <th width="30">Goods Carried</th>
            <th width="30">Scope of operation</th>
            <th width="30">Rear body application</th>
            <th width="30">Mileage per year</th>
            <th width="30">Road condition</th>
            <th width="30">Owns competitor CV</th>
            <th width="30">Payload</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->customer }}</td>
            <td>{{ $row->addr_line_1 . ' ' . $row->addr_line_2 . ' ' . $row->city . ' ' . $row->province }}</td>
            <td>{{ $row->model }}</td>
            <td>{{ $row->cs_no }}</td>
            <td>{{ $row->engine_no }}</td>
            <td>{{ $row->vin }}</td>
            <td>{{ $row->dealer }}</td>
            <td>{{ $row->delivery_date }}</td>
            <td>{{ $row->production_date }}</td>
            <td>{{ $row->goods_carried }}</td>
            <td>{{ $row->scope }}</td>
            <td>{{ $row->rba }}</td>
            <td>{{ $row->mileage }}</td>
            <td>{{ $row->road_condition }}</td>
            <td>{{ $row->has_competitor_cv }}</td>
            <td>{{ $row->payload }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

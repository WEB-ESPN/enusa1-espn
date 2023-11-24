<style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<html>
    <table class="center">
        <tr>
            <th colspan="2"><h3>{{ isset($inquiryForm['invoice_number']) ? $inquiryForm['invoice_number'] : '' }} Product Inquiry</h3></th>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ isset($inquiryForm['first_name']) ? $inquiryForm['first_name'] : '' }} {{ isset($inquiryForm['last_name']) ? $inquiryForm['last_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ isset($inquiryForm['email']) ? $inquiryForm['email'] : '' }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ isset($inquiryForm['phone_number']) ? $inquiryForm['phone_number'] : '' }}</td>
        </tr>
        <tr>
            <td>Company Name</td>
            <td>{{ isset($inquiryForm['company_name']) ? $inquiryForm['company_name'] : '' }}</td>
        </tr> 
        <tr>
            <td>Country</td>
            <td>{{ isset($inquiryForm['country']) ? $inquiryForm['country'] : '' }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ isset($inquiryForm['city']) ? $inquiryForm['city'] : '' }}</td>
        </tr>
        <tr>
            <td>Sub Distric</td>
            <td>{{ isset($inquiryForm['sub_distric']) ? $inquiryForm['sub_distric'] : '' }}</td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td>{{ isset($inquiryForm['product_name']) ? $inquiryForm['product_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>{{ isset($inquiryForm['category']) ? $inquiryForm['category'] : '' }}</td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>{{ isset($inquiryForm['quantity']) ? $inquiryForm['quantity'] : '' }}</td>
        </tr> 
        <tr>
            <td>Note</td>
            <td>{{ isset($inquiryForm['note']) ? $inquiryForm['note'] : '' }}</td>
        </tr> 
        <tr>
            <td>Payment Method</td>
            <td>{{ isset($inquiryForm['payment_method']) ? $inquiryForm['payment_method'] : '' }}</td>
        </tr> 
    </table>
</html>
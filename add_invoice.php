<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 



        
<!-- <script
    src="http://maps.googleapis.com/maps/api/js?key=YOUR_APIKEY&sensor=false">
</script> -->
    </head>

    <body>
        <div id="product_detail">
            <h3>Product Detail</h3><br/>
            <button type="submit" class="btn btn-t-primary" id="add" style="margin-left: 50%">Add</button>
            <div id="result"></div>
        </div>
    <div id="dynamic_field_modal" style="display:none">
        <form method="post" id="add_name">
        <table>
            <h4 class="modal-title">Product Add Detail</h4>
            <tr>
                <td>Customer name : </td>
                <td><input type="text" name="cname" id="cname"></td>
            </tr>

            <tr>
                <td>Customer email : </td>
                <td><input type="text" name="cemail" id="cemail"></td>
            </tr>

            <tr>
                <td>Products</td>
                <td>
                    <div align="right">
                        <!-- <button type="button" name="add" id="add" class="btn btn-info">Add</button> -->
                        <button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">Add</button>
                        <!-- <input type="button" name="add_more" id="add_more" class="btn btn-success btn-xs"> Add -->
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table" id="dynamic_field" border="2">

                        </table>
                    </div>

                </td>
            </tr>
            <tr>
                <td>Total Item :</td>
                <td><input type="text" name="total_item" id="total_item" readonly="readonly"></td>
            </tr>
            <tr>
                <td>Total Amount :</td>
                <td><input type="text" name="total_amount" id="total_amount" readonly="readonly"></td>
            </tr>
            <tr>
                <td>Total Discout Amount :</td>
                <td><input type="text" name="total_discount_amount" id="total_discount_amount" readonly="readonly"></td>
            </tr>
            <tr>
                <td>Total Bill :</td>
                <td><input type="text" name="total_bill" id="total_bill" readonly="readonly"></td>
            </tr>

            <tr>
                
                <td><br/><br/><input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Save" />
                    <!-- <button type="submit" class="btn btn-t-primary" id="back" style="margin-left: 50%">Back</button> -->
                    <input type="button" name="back" id="back"  value="Back" />

                    </td>
            </tr>
        </table>
        </form>
    </div>


    <!-- <div id="dynamic_view_modal" style="display:none">
        
        <table>
            
            <tr>
                <td>Customer name : </td>
                <td><input type="text" name="cname" id="cname"></td>
            </tr>

            <tr>
                <td>Customer email : </td>
                <td><input type="text" name="cemail" id="cemail"></td>
            </tr>

            <tr>
                <td>Products</td>
                <td>    
                    <div class="table-responsive">
                        <table class="table" id="dynamic_field" border="2">

                        </table>
                    </div>

                </td>
            </tr>
            <tr>
                <td>Total Item :</td>
                <td><input type="text" name="total_item" id="total_item"></td>
            </tr>
            <tr>
                <td>Total Amount :</td>
                <td><input type="text" name="total_amount" id="total_amount"></td>
            </tr>
            <tr>
                <td>Total Discout Amount :</td>
                <td><input type="text" name="total_discount_amount" id="total_discount_amount"></td>
            </tr>
            <tr>
                <td>Total Bill :</td>
                <td><input type="text" name="total_bill" id="total_bill"></td>
            </tr>

        </table>
        
    </div> -->
    </body>

    <script type="text/javascript">
        $(document).ready(function(){

            load_data();

            function load_data()
            {
                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    success:function(data)
                    {
                        $('#result').html(data);
                    }
                })
            }

            $(document).on('click', '.edit', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"JSON",
                    success:function(data)
                    {
                        $('#cname').val(data.cust_name);
                        $('#cemail').val(data.cust_email);
                        $('#total_item').val(data.total_item);
                        $('#total_amount').val(data.total_amount);
                        $('#total_discount_amount').val(data.total_discount);
                        $('#total_bill').val(data.total_bill);
                        $('#dynamic_field').html(data.product_name);
                        //$('#dynamic_field').html(data.tot_price);
                        $('#action').val('edit');
                        $('.modal-title').text("Edit Details");
                        $('#submit').val("Edit");
                        $('#hidden_id').val(id);
                        $('#dynamic_field_modal').show();
                        $('#product_detail').hide();
                        $('#back').show();
                    }
                });
            });

            $(document).on('click', '.view', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"JSON",
                    success:function(data)
                    {
                        $('#cname').val(data.cust_name);
                        $('#cemail').val(data.cust_email);
                        $('#total_item').val(data.total_item);
                        $('#total_amount').val(data.total_amount);
                        $('#total_discount_amount').val(data.total_discount);
                        $('#total_bill').val(data.total_bill);
                        $('#dynamic_field').html(data.product_name);
                        //$('#dynamic_field').html(data.tot_price);
                       // $('#action').val('view');
                        $('.modal-title').text("Product Detail");
                        $('#hidden_id').val(id);
                        $('#add_more').hide();
                        $('#submit').hide();
                        $('#dynamic_field_modal').show();
                        $('#product_detail').hide();
                    }
                });
            });


            $(document).on('click', '.delete', function(){
                var id = $(this).attr("id");
                if(confirm("Are you sure want to remove this data?"))
                {
                    $.ajax({
                        url:"delete.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data)
                        {
                            load_data();
                            alert("Data removed");
                        }
                    })
                }
            });

            $(document).on('click', '#back', function(){
                $('#dynamic_field_modal').hide();
                $('#product_detail').show();
                load_data();
            });    

            $('#add').click(function()
            {
                $('#dynamic_field').html('');
                add_dynamic_input_field(1);

                $('.modal-title').text('Add Details');
                $('#action').val("insert");
                $('#submit').val('Save');
                $('#add_name')[0].reset();
                $('#dynamic_field_modal').show();
                $('#product_detail').hide();
                $('#back').show();


            });

            var rowCount = 1;

            //add_dynamic_input_field(1);
            function add_dynamic_input_field(count)
            {
                var button = '';
                if(count == 1)
                {
                   // button = '<button type="button" name="remove" id="'+count+'" class="btn btn-danger btn-xs remove">x</button>';
                    output2 = '<tr>';
                    output2 = '<th>Product Name</th>';
                    output2 +='<th>Price</th><th>Discount(%)</th>';
                    output2+= '</tr>';
                    $('#dynamic_field').append(output2);
                }
                else
                {
                   // button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
                    
                }
                
                output = '<tr id="row'+count+'" class="all_data">';
                output += '<td><input type="text" name="product_name[]" placeholder="Product Name" class="form-control product_name" id="product_name_'+rowCount+'" for="'+rowCount+'"  /></td>';
                output +='<td><input type="text" name="tot_price[]" placeholder="Price" class="form-control tot_price" id="tot_price'+rowCount+'" for="'+rowCount+'" /></td><td><input type="text" name="tot_discount[]" placeholder="Discount" class="form-control tot_discount"  id="tot_discount'+rowCount+'" for="'+rowCount+'" /></td>';
               output+= '</tr>';
                //output += '<td align="center">'+button+'</td></tr>';
               $('#dynamic_field').append(output);
               // $('#dynamic_field').append('<tr>'+output+'</tr>');
                rowCount++;
                
                
            }

            $("#add_more").click(function() {
                //$(document).on('click', '#add_more', function(){
                var count = count + 1;
                add_dynamic_input_field(count);
            });

            

            $("#dynamic_field").on('input', 'input.product_name,input.tot_price,input.tot_discount', function() 
            {
                //console.log('hi');
                /*console.log($(this).attr("for"));
                return false;*/
                getTotalCost($(this).attr("for"));

            });

            // Using a new idex rather than your global variable i
            function getTotalCost(ind) {
              var subtotal_per=[];
              var j=0;
              var subtotal = 0; 
              var subdis = 0;
              var product = $('#product_name_'+ind).val();  
              var discount = $('#tot_discount'+ind).val();
              var price = $('#tot_price'+ind).val();
              //console.log(discount+'=='+price+'=='+product);
              //var totNumber = (qty * price);

              var discounts = $('.tot_discount');

              var totNumber = price

              //price = parseFloat(price);
              //discount = parseFloat(discount);
              
              //console.log(subtotal_per);

              //var tot = totNumber;
              //$('#total_cost_'+ind).val(tot);
              //calculateSubTotal();

              
              //console.log(count);

              $('.tot_price').each(function(i,e) {


                 subtotal += parseFloat($(this).val());

                 var percentage = Math.round(((parseFloat($(this).val()) /  100) * parseFloat(discounts[i].value)));
                 // console.log(parseFloat($(this).val()));
                 subdis += parseFloat(percentage);
                 var total_dis = (parseFloat($(this).val()) - percentage);
                 //console.log(total_dis);
                 subtotal_per[j++] = total_dis;

              });
              //console.log(subdis);
              if(subtotal > 0 || subtotal == 0)
              {
                $('#total_amount').val(subtotal);
              } 
              if(subdis > 0 || subdis == 0)
              {
                $('#total_discount_amount').val(subdis);
              }

              var total_item = $(".all_data").length;
              $('#total_item').val(total_item);
             // $('#total_discount_amount').val(subtotal_per);
             var t = 0;
             var newHTML = $.map(subtotal_per, function(value) {
                
                 t +=parseFloat(value);
                 
            });
             if(t > 0 || t == 0)
             {
                $('#total_bill').val(t);
             }
            }

            
            $('#add_name').on('submit', function(event){
                event.preventDefault();
                //console.log('hi');
                //console.log($('#cname').val());
                if($('#cname').val() == '')
                {
                    alert("Enter Customer Name");
                    return false;
                }

                if($('#cemail').val() == '')
                {
                    alert("Enter Customer Email");
                    return false;
                }else 
                {
                    $validEmail = validateEmail($('#cemail').val());
                    if($validEmail == false)
                    {
                        alert("Enter valid email");
                        return false;
                    }
                }

                

                var to_pr = 0;
                $('.product_name').each(function(){
                    if($(this).val() != '')
                    {
                        to_pr = to_pr + 1;
                    }
                });

                if(to_pr > 0)
                {
                    
                    var form_data = $(this).serialize();

                    var action = $('#action').val();
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:form_data,
                        success:function(data)
                        {
                            if(action == 'insert')
                            {
                                alert("Data Inserted");
                            }
                            if(action == 'edit')
                            {
                                alert("Data Edited");
                            }
                            add_dynamic_input_field(1);
                            
                            /**/
                            load_data();
                            $('#add_name')[0].reset();
                            $('#dynamic_field_modal').hide();
                            $('#product_detail').show();
                        }
                    });
                }
                else
                {
                    alert("Please Enter at least one Product");
                }
            }); 


            function validateEmail(email) 
            {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if( !emailReg.test( email ) ) {
                    return false;
                } else {
                    return true;
                }
            }


            function calculateSubTotal() {
              var subtotal = 0;
              $('.tot_price').each(function() {

                 subtotal += parseFloat($(this).val());

              });
              $('#total_amount').val(subtotal);
            }
            
           // var proc_id = $('#product_name').val();
            
            /*$('input.product_name').change(function() {
                // $(this).val() will work here
                console.log("hi");
                //var rowCount = $('#product_name >tbody >tr').length;
                //console.log(rowCount);
            });*/
                
                
             /*$('input[name="product_name[]"]').blur(function () {
                var i =1;
                
                    console.log(i);
                    i++;
            });*/
            /*function mainInfo(data) {
                   // body...
                var rowCount = $('.product_name >tbody >tr').length;
                console.log(rowCount);
            }  */ 
        });
        
    </script>
</html>
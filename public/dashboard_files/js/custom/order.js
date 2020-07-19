$(document).ready(function () {
    
    //add product btn
    $('.add-product-btn').on('click' , function(e){
        // alert('add product btn work');
        e.preventDefault(); 
        var name= $(this).data('name');
        var id =$(this).data('id');
        //format price with jquery number
        var price = $.number($(this).data('price'),2);

        //alert(name+ '' + price);
        $(this).removeClass('btn-success').addClass('btn-default disabled');

       // <input type="hidden" name="product_ids[]" value="${id}">--></input>
         var html =`
                    <tr>
                        <td>${name}</td>
                        <td> <input type='number'  name="product_ids[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min ="1" value="1"   > </td>
                        <td class="product-price"> ${price} </td>
                        <td> <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button> </td>
                    </tr>
         `;

        $('.order-list').append(html);
        //after add call
        calculateTotal();

       
    });

    //any disabled btn
    $('body').on('click', '.disabled', function(e) {

        e.preventDefault();

    });
    //remove product btn when clicked , remove btn-default disabled and add btn-success ,also remove this row
    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
       // alert('remove clicked');
       var id =$(this).data('id');
       //console.log(id);
       $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
       //remove a2rab row ('tr')
       $(this).closest('tr').remove();
       //after remove call 
       calculateTotal();

    });

    //change product quantity
    $('body').on('keyup change','.product-quantity', function(e){

        e.preventDefault();
       // alert($(this).val());
        var quantity=parseInt($(this).val());
        //alert(quantity);
       //var unitPrice = parseInt($(this).closest('tr').find('.product-price').html());
       //alert(unitPrice);
       var unitPrice =parseFloat($(this).data('price').replace(/,/g,''));
       var totalQuantityPrice = quantity * unitPrice;
       $(this).closest('tr').find('.product-price').html(totalQuantityPrice);
      
       calculateTotal();

    });


});//end of document ready

function calculateTotal(){

    var price = 0;

    //each like loop
    $('.order-list .product-price').each(function(index){

        price += parseFloat($(this).html().replace(/,/g,''));

    });
    //alert(price);
    $('.total-price').html($.number(price,2));

    $('#product-quantity')
    
    //check if price > 0 and remove or add class disabled
    if(price > 0)
    {
        $('#add-order-form-btn').removeClass('disabled');
    }else{
        $('#add-order-form-btn').addClass('disabled');
    }
   
}//end of calculate_total
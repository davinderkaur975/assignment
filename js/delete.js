/**
 * Created by Davinder Kaur on 15-06-2017.
 */

//use jQuery for a delete confirmation pop-up
$('.confirmation').on('click', function(){
    return confirm('Are you sure you want to delete this item?');
});
# CS2623 — Week 1 Copilot Notes

to answer the question on the worksheet, $_POST is when you just want a submitted value, and filter_input() is when you want to validate and clean said input before using it.

options with filter_input() is what it sounds like (to me). say if $options == null, then it wont read anything. but if $options == false, itll receive something, but mark it invalid
FILTER_REQUIRED_ARRAY specifically asks for the code to contain an array, and if it doesnt have it, itll mark false or behave unexpectedly

## Accepted

i was having issues on SSP05_2 with the values showing a yellow variable warning. it was recommended i declare the variables like this to get rid of them:
        $customer = '';
        $product = '';
        $quantity = null;
        $payment = '';
        $instructions = '';
        $options = [];
and it worked!

## Rejected



## Improved

when creating the css, it ended up looking a lot different than previous weeks, i asked it to make the css similar to how it was last week, and now it meshes in perfectly with it

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>

    <title>Glumos || Stripe Integration</title>
  </head>
  <style>
      body{
          background:rgb(0 0 0/5%);
      }
      #card-element{
          width:100%;
      }
  </style>
  <body>
<?php 
if($subscribed=="0"){?>
<div class="container py-5 pt-2 px-3 w-25 bg-white rounded-4 shadow-lg m-auto mt-5">
    <div class="text-center">
        <img src="<?php echo base_url('/httpdocs/images/glumos-logo.png');?>" class="" style="height:150px;width:150px;"/>
        <p class="m-0 mb-2 text-center text-murted text-primary fw-bolder">Checkout for Subscription in Glumos</p>
    </div>
    <form method="POST" action="<?php echo base_url('/go-stripe');?>"  id="payment-form">
        <div class="mb-3">
            <?php $session=session();?>
  <label for="exampleFormControlInput1" class="form-label fw-bolder">Email address</label>
  <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
  value="<?=$session->get('userdata')['email'];?>"
  placeholder="name@example.com" readonly>
         </div>
         
         <div class="mb-3">
  <label for="examplemControlInput1" class="form-label fw-bolder">Card Holder Name</label>
  <input type="text" name="card_holder" class="form-control" id="examplemControlInput1" placeholder="Enter Name Here">
         </div>
         
         <div class="mb-3">
         <div class="form-row">
    <label for="card-element fw-bolder" style="font-weight:700">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert" style="color:red"></div>
  </div>
         </div>
         
         
         <div class="mb-5">
          <button type="submit" class="btn btn-primary w-100 text-white fw-bolder">Checkout</button>
         </div>
         <div class="mb-3">
             <a class="btn btn-secondary text-white fw-bolder  w-100" href="<?php echo base_url();?>">Go Back</a>
         </div>

    </form>
</div>

<?php }elseif($subscribed=="1"){?>
  <div clas="col-md-9 mx-auto py-5 px-2 bg-white text-center shadow-lg" id="success-div" style="background:white;width:500px;margin:auto;padding:100px;border-radius:20px;margin-top:100px;">
      <?php if($res->status=='trialing'){?> <p class="text-center  text-primary fw-bolder">FREE TRIAL 1 month </p>  <?}?> 
      <h1 class="text-center">You are Subscribed Now</h1>
      <p class="text-center m-auto text-muted fw-bolder">
        Your  <?php if($res->status=='trialing'){?> <span class="text-success">FREE</span>  <?}?> subscription will end at<br>
         <span class="text-primary h4"><?php print_r(date('d M Y',$res->period_end));?></span>   
      </p>
      <h1 class="text-center mt-3"><span class="material-icons-outlined" style="background:#012bff;color:white;border-radius:50%;font-size:60px">check</span></h1>
      
      <a class="btn btn-secondary text-white fw-bolder  w-100 mt-5" href="<?php echo base_url();?>">Go Back</a>
  </div>  

<?php }else{?>
  <div clas="col-md-9 mx-auto p-5 bg-white text-center shadow-lg" id="success-div" style="background:white;width:500px;margin:auto;padding:100px;border-radius:20px;margin-top:100px;">
      <h1 class="text-center">Some error Occured</h1>
      <h1 class="text-center mt-3"><span class="material-icons-outlined" style="background:white;color:red;font-size:60px">warning</span></h1>
  </div>


<?php }?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
  <script>
      // Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe('pk_test_51KLSa5JWHIkbNS80pLDJel5mQFfDoYqIVUXqnB3NkVYZztbVy4ILtzr5Ga4rXcKlJbbLIPcV2wb6hKSQy8STLt7u00oEJ3d3Tu');
//pk_live_51KLSa5JWHIkbNS801wN54fN3ww1FHafffRW2QCRJ0evxyadGPCoDVpKQw52zN6ocIYnmyt6sF7XiLRr8LeB4Z2Ec00uX6056x4
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');


// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

  </script>
</html>
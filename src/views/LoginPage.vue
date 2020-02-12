<template>
  <div class="LoginPage text-center my-5">
   <b-container>
     <form class="form-signin text-secondary">
      <h1 class="h3 mb-3 font-weight-normal">Bitte anmelden</h1>
      <label for="inputUid" class="sr-only my-2">J-User</label>
      <input type="text" id="inputUid" class="form-control my-2" placeholder="J-User" required autofocus>
      <label for="inputPassword" class="sr-only my-2">Passwort</label>
      <input type="password" id="inputPassword" class="form-control my-2" placeholder="Password" required>
      <button class="btn btn-lg btn-secondary btn-block" type="submit">Los</button>
    </form>
   </b-container>
  </div>
</template>


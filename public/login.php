<!-- login page with form -->

<?=template_header('Home')?>
<div class="w-full bg-cover bg-no-repeat bg-center" style="background-image: url(img/BeachCourse.jpg)">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
      <div class="w-96 bg-white rounded-lg shadow">
          <div class="p-6 space-y-4">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900">
                  Please Sign In
              </h1>
              <form class="space-y-4 md:space-y-6" action="authenticate.php" method="post">
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username:</label>
                      <input
                       type="text" 
                       name="username" 
                       id="username" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                       placeholder="Username" 
                       required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password:</label>
                      <input
                       type="password" 
                       name="password" 
                       id="password" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                       placeholder="*************"
                       required="">
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input 
                            id="remember" 
                            aria-describedby="remember" 
                            type="checkbox" 
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500">Remember me</label>
                          </div>
                      </div>
                  </div>
                  <button type="submit" class="w-full text-white bg-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:scale-110 hover:font-bold hover:underline">Sign in</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don’t have an account yet? &nbsp;<a href="index.php?page=signup" class="text-blue-700 underline hover:underline hover:font-bold dark:text-primary-500">Sign up</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</div>
<?=template_footer()?>
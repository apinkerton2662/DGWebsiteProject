<?=template_header('signup')?>
<div class="w-full bg-cover bg-no-repeat bg-center" style="background-image: url(img/HawaiiCourse.jpg)"> 
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <div class="w-96 bg-white rounded-lg shadow">
            <div class="p-6 space-y-4">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900">Register for exclusive discounts</h1>
                <form class="space-y-4 md:space-y-6" action="register.php" method="post">
                    <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">First Name:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="firstname" 
                    placeholder="First Name" 
                    id="firstname" 
                    required>

                    <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Last Name:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="lastname" 
                    placeholder="Last Name" 
                    id="lastname" 
                    required>

                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="email" 
                    name="email" 
                    placeholder="E-Mail" 
                    id="email"
                    required>

                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Street Address:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="address" 
                    placeholder="Street Address" 
                    id="address">

                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="city" 
                    placeholder="City" 
                    id="city">

                    <label for="state" class="block mb-2 text-sm font-medium text-gray-900">State:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="state" 
                    placeholder="State" 
                    id="state">

                    <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900">Zip Code:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="zipcode" 
                    placeholder="Zip Code" 
                    id="zipcode">

                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="tel" 
                    name="phone" 
                    placeholder="Phone Number" 
                    id="phone">

                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="text" 
                    name="username" 
                    placeholder="Username" 
                    id="username" 
                    required>

                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" 
                    type="password" 
                    name="password" 
                    placeholder="**********" 
                    id="password" 
                    required>
                        
                    <button type="submit" class="w-full text-white bg-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:scale-110 hover:font-bold hover:underline">Sign Up!</button>
                    
                </form>

            </div>
    
        </div>
    </div>
</div>

<?=template_footer()?>
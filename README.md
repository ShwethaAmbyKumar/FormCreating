Create a Laravel project using composer:
composer create-project --prefer-dist laravel/laravel contact-form

Navigate to the project directory and install the required packages using NPM:
cd contact-form
npm install vue axios

Create a new controller that will handle the form submission and save the data in the database:
php artisan make:controller ContactController

Open the newly created ContactController and add the following method to save the contact information:
use App\Models\Contact;

public function saveContact(Request $request)
{
    $validatedData = $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
    ]);

    $contact = new Contact();
    $contact->firstname = $request->firstname;
    $contact->lastname = $request->lastname;
    $contact->street = $request->street;
    $contact->housenumber = $request->housenumber;
    $contact->zip_code = $request->zip_code;
    $contact->city = $request->city;
    $contact->email = $request->email;
    $contact->save();

    // Send notification email here
}

Create a new model for the Contact entity:
php artisan make:model Contact

Create a migration to create the contacts table:
php artisan make:migration create_contacts_table --create=contacts

Open the migration file and define the schema for the contacts table:
Schema::create('contacts', function (Blueprint $table) {
    $table->id();
    $table->string('firstname');
    $table->string('lastname');
    $table->string('street')->nullable();
    $table->string('housenumber')->nullable();
    $table->string('zip_code')->nullable();
    $table->string('city')->nullable();
    $table->string('email');
    $table->timestamps();
});

Run the migration to create the contacts table:
php artisan migrate

Create a new Vue.js component for the contact form:
npm run dev
php artisan make:component ContactForm

Open the ContactForm and refer the file(form.php and contactcontroller.php for the rest of the saving data)

In the vue.js form file(form.php), we have created a Vue component with a form that includes input fields for all the required contact information fields. We have also included a submit button that will trigger the submitForm method when clicked.
In the submitForm method, we create a data object with all the form field values and then make a POST request to the Laravel REST API endpoint for saving contacts. We use the Axios library to make the AJAX call and handle the response and errors accordingly.
For Saving contacts we have created the Laravel REST API endpoints
Creating the code for the ContactController in Laravel for saving contacts:(contactcontroller.php).
In the contactcontroller.php code, we have defined a store method in the ContactController that will handle the POST request for saving contact information. We use Laravel's validation feature to validate the request data and create a new Contact model using the validated data. After that, we send an email notification to the user using the ContactNotification Mailable. Finally, we return a JSON response with a success message and the saved contact information.

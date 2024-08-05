<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    @vite('resources/js/app.js')

</head>

<body>
    <h1 class="text-3xl font-bold underline">Create an Account</h1>
    <form method="post" action="{{ route('user.store' ) }}">
        @csrf
        @method('post')

        <div>
            <label>Name</label>
            <input type="text" class="shadow appearance-none border rounded w-500 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" />
        </div>

        <div>
            <label>User Category</label>
            <select class="form-select" name="user_category_id" id="user_category_id">
                @foreach($userCategories as $userCategory)
                <option value="{{ $userCategory->id }}">{{ $userCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="student_id_field">
            <label>Student ID</label>
            <input type="text" class="shadow appearance-none border rounded w-500 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" data-inputmask="'mask': '9999-99999-**-9'" name="student_id" placeholder="0000-00000-BR-0" />
        </div>

        <div>
            <label>Birthday</label>
            <select class="form-select" name="birth_month">
                <option value="">Select Month</option>
                @for ($month = 1; $month <= 12; $month++) <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                    @endfor
            </select>

            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="daySelect" name="birth_day">
                <option selected>Day</option>
            </select>

            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="yearSelect" name="birth_year">
                <option selected>Year</option>
            </select>

            <div>
                <label>Password</label>
                <input type="text" class="form-control" name="password" />
            </div>

            <div>
                <label>Email</label>
                <input type="text" class="form-control" name="email" />
            </div>

        </div>

        <div>
            <button class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" type="submit" name="submit">Submit</button>
        </div>

        <!-------------------------------------------------------------------Start of JS------------------------------------------------------------------>
        <!--For Birthday-->
        <script>
            var select = document.getElementById("daySelect");

            for (var i = 1; i <= 31; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = i;
                select.appendChild(option);
            }
        </script>

        <!--For BirthYear-->
        <script>
            var select = document.getElementById("yearSelect");

            for (var i = 2013; i >= 1900; i--) {
                var option = document.createElement("option");
                option.value = i;
                option.text = i;
                select.appendChild(option);
            }
        </script>

        <!--For the Student ID-->
        <script>
            $(document).ready(function() {
                $('[data-inputmask]').inputmask();
            });
        </script>

        <script>
            // Show/hide 'student_id' field based on 'user_category_id' selection
            document.getElementById('user_category_id').addEventListener('change', function() {
                var studentIdField = document.getElementById('student_id_field');
                if (this.value == 1) { // Assuming 1 is the ID for "Student"
                    studentIdField.style.display = 'block';
                } else {
                    studentIdField.style.display = 'none';
                }
            });
        </script>
        <!-------------------------------------------------------------------End of JS------------------------------------------------------------------>

    </form>
</body>

</html>
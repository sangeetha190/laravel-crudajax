<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1> Edit Task Manager</h1>

    <form id="editTaskForm">
        @csrf <!-- Laravel CSRF token -->
        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" required value="{{ $dataList->title }}">
        <br />
        <label for="description">Task Description:</label>
        <textarea id="description" name="description" required>{{ $dataList->description }}</textarea>

        <button type="submit">Edit Task</button>
    </form>

    <script>
        $(document).ready(function() {

            // Create a new task
            $('#editTaskForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'PUT',
                    url: '/edit/' + {{ $dataList->id }},
                    data: $('#editTaskForm').serialize(),
                    success: function(data) {

                        // Handle the success response (e.g., show a success message)
                        console.log(data.message);
                        // Clear the form
                        $('#editTaskForm')[0].reset();

                        // Extract the URL from the JSON response
                        var redirectUrl = data.url;

                        // Redirect to the new URL using JavaScript
                        window.location.href = redirectUrl;
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., validation errors or task not found)
                        if (xhr.status === 404) {
                            console.log('Task not found.');
                        } else if (xhr.status === 422) {
                            console.log('Validation error. Please check your data.');
                        } else {
                            console.log('An error occurred while updating the task.');
                        }
                    }
                });
            });
        });
    </script>





</body>

</html>

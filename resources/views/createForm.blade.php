<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Task Manager</h1>

    <form id="createTaskForm">
        @csrf <!-- Laravel CSRF token -->
        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Task Description:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Create Task</button>
    </form>

    <h2>Task List</h2>
    <ul id="taskList">
        <!-- Tasks will be appended here using JavaScript -->

    </ul>

    <script>
        $(document).ready(function() {

            // Create a new task
            $('#createTaskForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/tasks',
                    data: $('#createTaskForm').serialize(),
                    success: function(data) {
                        // Clear the form
                        $('#createTaskForm')[0].reset();

                        // Extract the URL from the JSON response
                        var redirectUrl = data.url;

                        // Redirect to the new URL using JavaScript
                        window.location.href = redirectUrl;
                    }
                });
            });
        });
    </script>
</body>

</html>

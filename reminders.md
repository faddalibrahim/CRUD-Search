1. for view pages, make sure there is an option for "no such item exists" -- if the id does not exist in database
2. also make sure to redirect to index page if no GET info was passed -- like view.php, instead of view.php?id=12.
3. do the above for inc files as well.
4. customize errors for database queries
5. use null coalesing
6. use htmlspecialchars
7. use mysqli_real_escape_string

8.toLowerCase
9.strip/trim
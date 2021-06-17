
require('./bootstrap');

// Delete post confirm

const delForm = document.querySelectorAll('.delete-post-form');

delForm.forEach(from => {
    from.addEventListener('submit', function(e) {
       const resp = confirm('Do you really want to delete this post?');

       if(! resp) {
           e.preventDefault();
       }
    });
});

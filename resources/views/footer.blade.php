</div>

<script>
    function change() {
        // get the selected option value

        var selectedValue = document.getElementById("project").value;

        window.location.href = "/" + selectedValue;
    }

    function edit(id) {

        var task_id = id;

        // AJAX 
        $.ajax({
            url: "{{ route('task_detail') }}",
            type: "POST",
            data: {
                task_id: task_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);

                // json decode
                response = JSON.parse(response);

                document.getElementById("task_name").value = response.task_name;
                document.getElementById("task_id").value = response.task_id;

                // show the modal
                $("#edit_task").modal("show");
            }
        });
    }
</script>

<script>
    // Select the container element
    var sortableList = document.getElementById('sortable-list');
    // Store the original order
    var originalOrder = Array.from(sortableList.children).map(function(item) {
        return item.dataset.id;
    });

    var sortable = new Sortable(sortableList, {
        onUpdate: function(evt) {
            // Code to run when an item is dropped and the order is updated
            // get the dragged element and its destination
            var itemEl = evt.item; // dragged HTMLElement
            // get the task id
            var task_id = itemEl.dataset.id;

            // get the dragged element's order
            var to = evt.newIndex + 1;
            var from = evt.oldIndex + 1;

            console.log('from: ' + from + ' to: ' + to);

            // AJAX
            $.ajax({
                url: "{{ route('update_priority') }}",
                type: "POST",
                data: {
                    from: from,
                    to: to,
                    task_id: task_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    // update the original order
                    response = JSON.parse(response);
                    if (response.msg == 'success') {
                        var newOrder = Array.from(sortableList.children).map(function(item) {
                            return item.dataset.id;
                        });
                        originalOrder = newOrder;
                    } else {
                        Array.from(sortableList.children).forEach(function(item, index) {
                            var originalIndex = originalOrder.indexOf(item.dataset.id);
                            sortableList.insertBefore(item, sortableList.children[
                                originalIndex]);
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                    // place the moved element back to its original position
                    Array.from(sortableList.children).forEach(function(item, index) {
                        var originalIndex = originalOrder.indexOf(item.dataset.id);
                        sortableList.insertBefore(item, sortableList.children[
                            originalIndex]);
                    });
                }
            });

        },
    });
</script>


<script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('/assets/js/main.js') }}"></script>

<script src="{{ asset('/assets/js/extended-ui-perfect-scrollbar.js') }}"></script>

<script src="{{ asset('/assets/js/ui-toasts.js') }}"></script>
</body>

</html>

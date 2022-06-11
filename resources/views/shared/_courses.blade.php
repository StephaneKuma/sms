<script>
    function getCourses(obj) {
        let class_id = obj.options[obj.selectedIndex].value

        let url = "{{ route('settings.courses.by.class.id') }}?class_id=" + class_id

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            let courseSelect = document.getElementById('course_id')
            courseSelect.options.length = 0

            let courses = data.courses
            if (courses.length) {
                courses.unshift({'id': 0, 'name': 'Choisir un cours'})
                courses.forEach(function(course, key) {
                    courseSelect[key] = new Option(course.name, course.id)
                })
            } else {
                courses.unshift({'id': 0, 'name': 'Veuillez créer un cours pour cette classe'})
                courses.forEach(function(course, key) {
                    courseSelect[key] = new Option(course.name, course.id)
                })
            }
        })
        .catch(function(error) {
            console.log(error)
        })
    }
</script>

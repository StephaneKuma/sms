<script>
    function getCoursesAndSections(obj) {
        let class_id = obj.options[obj.selectedIndex].value

        let url = "{{ route('settings.courses.and.sections.by.class.id') }}?class_id=" + class_id

        fetch(url)
            .then((resp) => resp.json())
            .then(function(data) {
                let sectionSelect = document.querySelector('.section_id')
                sectionSelect.options.length = 0

                let courseSelect = document.querySelector('.course_id')
                courseSelect.options.length = 0

                let sections = data.class.sections
                if (sections.length) {
                    sections.unshift({
                        'id': 0,
                        'name': 'Choisir une section'
                    })
                    sections.forEach(function(section, key) {
                        sectionSelect[key] = new Option(section.name, section.id)
                    })
                } else {
                    sections.unshift({
                        'id': 0,
                        'name': 'Veuillez créer une section pour cette classe'
                    })
                    sections.forEach(function(section, key) {
                        sectionSelect[key] = new Option(section.name, section.id)
                    })
                }

                let courses = data.class.courses
                if (courses.length) {
                    courses.unshift({
                        'id': 0,
                        'name': 'Choisir un cours'
                    })
                    courses.forEach(function(course, key) {
                        courseSelect[key] = new Option(course.name, course.id)
                    })
                } else {
                    courses.unshift({
                        'id': 0,
                        'name': 'Veuillez créer un cours pour cette classe'
                    })
                    courses.forEach(function(course, key) {
                        courseSelect[key] = new Option(course.name, course.id)
                    })
                }
            })
            .catch(function(error) {
                console.log(error.message)
            })
    }
</script>

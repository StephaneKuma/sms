<script>
    function getSections(obj, index) {
        let class_id = obj.options[obj.selectedIndex].value

        let url = "{{ route('settings.sections.by.class.id') }}?class_id=" + class_id

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            let sectionSelect = document.getElementById('section_id-' + index)
            sectionSelect.options.length = 0

            let sections = data.sections
            if (sections.length) {
                sections.unshift({'id': 0, 'name': 'Choisir une section'})
                sections.forEach(function(section, key) {
                    sectionSelect[key] = new Option(section.name, section.id)
                })
            } else {
                sections.unshift({'id': 0, 'name': 'Veuillez créer une section pour cette classe'})
                sections.forEach(function(section, key) {
                    sectionSelect[key] = new Option(section.name, section.id)
                })
            }
        })
        .catch(function(error) {
            console.log(error)
        })
    }
</script>

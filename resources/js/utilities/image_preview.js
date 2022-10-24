const imageField = document.getElementById('dish-image-field');
const imagePreview = document.getElementById('dish-image-preview');
const placeholder = 'https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg';

imageField.addEventListener('input', () => {
    if(imageField.files && imageField.files[0]){
        let reader = new FileReader();
        reader.readAsDataURL(imageField.files[0])
        reader.onload = e => {
            imagePreview.src = e.target.result;
        }
    } else imagePreview.src = placeholder;
})

const imageField = document.getElementById('image-field');
const imagePreview = document.getElementById('image-preview');
const placeholder = 'https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg';
console.log('pippo');
imageField.addEventListener('input', () => {
    if(imageField.files && imageField.files[0]){
        let reader = new FileReader();
        reader.readAsDataURL(imageField.files[0])
        reader.onload = e => {
            imagePreview.src = e.target.result;
        }
    } else imagePreview.src = placeholder;
})
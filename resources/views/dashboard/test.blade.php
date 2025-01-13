<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <div>
        <h2>Upload Image and Preview</h2>
        <input type="file" id="imageInput" accept="image/*" onchange="previewImage(event)">
        <div>
            <img id="imagePreview" src="" alt="Image Preview"
                style="display: none; max-width: 300px; max-height: 300px;">
        </div>
    </div>


</x-layout>

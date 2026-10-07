{{--
    Live preview for single-image file inputs. Mark an input with:
      data-preview="<img id>"                     image element that shows the preview (required)
      data-preview-placeholder="<element id>"     shown only while there is no image (optional)
      data-preview-container="<element id>"       hidden while there is no image (optional)
      data-preview-name="<element id>"            receives the selected file name (optional)
      data-preview-action="<element id>"          its text becomes "Change image" once a file is chosen (optional)
    Cancelling the file dialog restores the original image.
--}}
@once
<script>
    (function () {
        function byId(id) { return id ? document.getElementById(id) : null; }

        document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
            const img = byId(input.dataset.preview);
            if (!img) return;

            const placeholder = byId(input.dataset.previewPlaceholder);
            const container = byId(input.dataset.previewContainer);
            const nameLabel = byId(input.dataset.previewName);
            const originalSrc = img.getAttribute('src') || '';
            const originalName = nameLabel ? nameLabel.textContent : '';
            const actionLabel = byId(input.dataset.previewAction);
            const originalAction = actionLabel ? actionLabel.textContent : '';
            let objectUrl = null;

            function setVisible(hasImage) {
                img.classList.toggle('hidden', !hasImage);
                if (placeholder) placeholder.classList.toggle('hidden', hasImage);
                if (container) container.classList.toggle('hidden', !hasImage);
            }

            function restore(message) {
                if (originalSrc) {
                    img.src = originalSrc;
                } else {
                    img.removeAttribute('src');
                }
                setVisible(!!originalSrc);
                if (nameLabel) nameLabel.textContent = message || originalName;
                if (actionLabel) actionLabel.textContent = originalAction;
            }

            input.addEventListener('change', function () {
                if (objectUrl) {
                    URL.revokeObjectURL(objectUrl);
                    objectUrl = null;
                }

                const file = input.files && input.files[0];
                if (!file) return restore();

                if (!file.type.startsWith('image/')) {
                    input.value = '';
                    return restore('Please choose an image file.');
                }

                objectUrl = URL.createObjectURL(file);
                img.src = objectUrl;
                setVisible(true);
                if (nameLabel) nameLabel.textContent = 'New image selected: ' + file.name;
                if (actionLabel) actionLabel.textContent = 'Change image';
            });
        });
    })();
</script>
@endonce

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create a Course</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Create a Course</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <form id="courseForm" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="course-section">
            <div class="form-row">
                <div class="form-group">
                    <label>Course Title</label>
                    <input type="text" name="title" value="{{ old('title') }}">
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label>Feature Video</label>
                    <input type="file" name="feature_video" accept="video/*">
                    <div class="error-message"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-third">
                    <label>Level</label>
                    <input type="text" name="level" value="{{ old('level') }}">
                    <div class="error-message"></div>
                </div>

                <div class="form-group-third">
                    <label>Category</label>
                    <select name="category">
                        <option value="">Choose...</option>
                        <option value="programming" {{ old('category') == 'programming' ? 'selected' : '' }}>Programming</option>
                        <option value="design" {{ old('category') == 'design' ? 'selected' : '' }}>Design</option>
                        <option value="marketing" {{ old('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                    </select>
                    <div class="error-message"></div>
                </div>

                <div class="form-group-third">
                    <label>Course Price</label>
                    <input type="number" name="price" value="{{ old('price') }}">
                    <div class="error-message"></div>
                </div>
            </div>

            <div class="form-group-summary">
                <label>Course Summary</label>
                <textarea name="summary" rows="3">{{ old('summary') }}</textarea>
                <div class="error-message"></div>
            </div>

            <div>
                <label class="label-feature-image">Feature Images</label>
                <input type="file" id="image-upload" name="feature_image[]" accept="image/*" multiple>
                <label for="image-upload" class="custom-file-button">Choose File</label>
                <div id="image-preview-container"></div>
                <div class="error-message"></div>
            </div>
        </div>

        <div class="module-section">
            <div id="modules">
                <h2 class="module-section-title">Modules</h2>
                <div class="module-row">
                    <div class="module" data-index="0">
                        <div class="module-header">
                            <h3 class="module-title">Module 1</h3>
                            <button type="button" class="collapse-btn" data-target="#module-content-0"></button>
                        </div>

                        <div class="collapsible-content" id="module-content-0">
                            <div>
                                <label>Module Title</label>
                                <input type="text" name="modules[0][title]" value="{{ old('modules.0.title') }}">
                                <div class="error-message"></div>
                            </div>
                            
                            <div class="content-section">
                                <div class="contents">
                                    <h4 class="content-section-title">Contents</h4>
                                    <div class="content-row">
                                        <div class="content" data-index="0">
                                            <div class="content-header">
                                                <h5 class="content-title">Content 1</h5>
                                                <button type="button" class="collapse-btn" data-target="#content-0-0"></button>
                                            </div>

                                            <div class="collapsible-content" id="content-0-0">
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label>Content Title</label>
                                                        <input type="text" name="modules[0][contents][0][title]" value="{{ old('modules.0.contents.0.title') }}">
                                                        <div class="error-message"></div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Video Source Type</label>
                                                        <select name="modules[0][contents][0][source_type]">
                                                            <option value="">Choose...</option>
                                                            <option value="youtube" {{ old('modules.0.contents.0.source_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                                            <option value="vimeo" {{ old('modules.0.contents.0.source_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                                            <option value="upload" {{ old('modules.0.contents.0.source_type') == 'upload' ? 'selected' : '' }}>Upload</option>
                                                            <option value="direct" {{ old('modules.0.contents.0.source_type') == 'direct' ? 'selected' : '' }}>Direct URL</option>
                                                        </select>
                                                        <div class="error-message"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label>Video URL</label>
                                                        <input type="text" name="modules[0][contents][0][video_url]" value="{{ old('modules.0.contents.0.video_url') }}" placeholder="https://example.com/video">
                                                        <div class="error-message"></div>
                                                    </div>
    
                                                    <div class="form-group">
                                                        <label>Video Length (minutes)</label>
                                                        <input type="number" name="modules[0][contents][0][video_length]" value="{{ old('modules.0.contents.0.video_length') }}" min="0" step="0.5" placeholder="e.g., 15.5">
                                                        <div class="error-message"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remove-btn-group">
                                            <button type="button" class="remove-content remove-btn">
                                                X
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="add-content">Add Content +</button>
                            </div>
                        </div>
                    </div>

                    <div class="remove-btn-group">
                        <button type="button" class="remove-module remove-btn">
                            X
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="add-module">Add Module +</button>
        </div>

        <div class="btn-section">
            <button type="submit" class="save-btn">Save</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </div>
    </form>

    <script>
        let moduleIndex = 1;
        let contentCounters = { 0: 1 };

        // Add Module
        $(document).on('click', '.add-module', function () {
            const newModuleIndex = moduleIndex;
            const moduleHtml = getModuleHtml(newModuleIndex);

            $('#modules').append(moduleHtml);

            contentCounters[newModuleIndex] = 1;
            moduleIndex++;
        });

        // Add Content
        $(document).on('click', '.add-content', function () {
            const module = $(this).closest('.module');
            const moduleIdx = module.data('index');
            const contentIdx = contentCounters[moduleIdx]++;
            const contentHtml = getContentHtml(moduleIdx, contentIdx);

            module.find('.contents').append(contentHtml);
        });

        // Remove Module
        $(document).on('click', '.remove-module', function () {
            if ($('#modules .module').length > 1) {
                $(this).closest('.module-row').remove();
                renumberModules();
            } else {
                alert('At least one module is required.');
            }
        });

        // Remove Content
        $(document).on('click', '.remove-content', function () {
            const module = $(this).closest('.module');
            if (module.find('.content').length > 1) {
                $(this).closest('.content-row').remove();
                renumberContents(module);
            } else {
                alert('At least one content is required per module.');
            }
        });

        // Collapse toggle
        $(document).on('click', '.collapse-btn', function (e) {
            e.stopPropagation();

            const targetId = $(this).data('target');
            const $target = $(targetId);

            if ($target.length) {
                const $contentWrapper = $(this).closest('.content, .module');
                
                $target.slideToggle(200);

                $contentWrapper.toggleClass('collapsed');

                $(this).toggleClass('active');
            } else {
                console.warn('Collapse target not found:', targetId);
            }
        });

        // Helper: Generate module block HTML
        function getModuleHtml(moduleIdx) {
            return `
                <div class="module-row">
                    <div class="module" data-index="${moduleIdx}">
                        <div class="module-header">
                            <h3 class="module-title">Module ${moduleIdx + 1}</h3>
                            <button type="button" class="collapse-btn" data-target="#module-content-${moduleIdx}"></button>
                        </div>

                        <div class="collapsible-content" id="module-content-${moduleIdx}">
                            <div>
                                <label>Module Title</label>
                                <input type="text" name="modules[${moduleIdx}][title]">
                                <div class="error-message"></div>
                            </div>

                            <div class="content-section">
                                <h4 class="content-section-title">Contents</h4>
                                <div class="contents">
                                    ${getContentHtml(moduleIdx, 0)}
                                </div>
                                <button type="button" class="add-content">Add Content +</button>
                            </div>
                        </div>
                    </div>
                    <div class="remove-btn-group">
                        <button type="button" class="remove-module remove-btn">X</button>
                    </div>
                </div>
            `;
        }

        // Helper: Generate content block HTML
        function getContentHtml(moduleIdx, contentIdx) {
            return `
                <div class="content-row">
                    <div class="content" data-index="${contentIdx}">
                        <div class="content-header">
                            <h5 class="content-title">Content ${contentIdx + 1}</h5>
                            <button type="button" class="collapse-btn" data-target="#content-${moduleIdx}-${contentIdx}"></button>
                        </div>

                        <div class="collapsible-content" id="content-${moduleIdx}-${contentIdx}">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Content Title</label>
                                    <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][title]">
                                    <div class="error-message"></div>
                                </div>

                                <div class="form-group">
                                    <label>Video Source Type</label>
                                    <select name="modules[${moduleIdx}][contents][${contentIdx}][source_type]">
                                        <option value="">Choose...</option>
                                        <option value="youtube">YouTube</option>
                                        <option value="vimeo">Vimeo</option>
                                        <option value="upload">Upload</option>
                                        <option value="direct">Direct URL</option>
                                    </select>
                                    <div class="error-message"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Video URL</label>
                                    <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_url]" placeholder="https://example.com/video">
                                    <div class="error-message"></div>
                                </div>

                                <div class="form-group">
                                    <label>Video Length (minutes)</label>
                                    <input type="number" name="modules[${moduleIdx}][contents][${contentIdx}][video_length]" min="0" step="0.5" placeholder="e.g., 15.5">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="remove-btn-group">
                        <button type="button" class="remove-content remove-btn">X</button>
                    </div>
                </div>
            `;
        }

        // Renumber all modules
        function renumberModules() {
            $('#modules .module').each(function (i) {
                $(this).data('index', i);
                $(this).find('.module-title').text(`Module ${i + 1}`);
                $(this).find('input, select, textarea').each(function () {
                    let name = $(this).attr('name');
                    name = name.replace(/modules\[\d+\]/, `modules[${i}]`);
                    $(this).attr('name', name);
                });
                renumberContents($(this));
            });
            moduleIndex = $('#modules .module').length;
        }

        // Renumber contents inside each module
        function renumberContents(module) {
            const moduleIdx = module.data('index');
            module.find('.content').each(function (i) {
                $(this).data('index', i);
                $(this).find('.content-title').text(`Content ${i + 1}`);
                $(this).find('input, select').each(function () {
                    let name = $(this).attr('name');
                    name = name.replace(/modules\[\d+\]\[contents\]\[\d+\]/, `modules[${moduleIdx}][contents][${i}]`);
                    $(this).attr('name', name);
                });
                $(this).find('.collapsible-content').attr('id', `content-${moduleIdx}-${i}`);
                $(this).find('.collapse-btn').attr('data-target', `#content-${moduleIdx}-${i}`);
            });
            contentCounters[moduleIdx] = module.find('.content').length;
        }

        // Feature Images
        const input = document.getElementById('image-upload');
        const previewContainer = document.getElementById('image-preview-container');
        let storedFiles = []; // Keep files in memory manually

        input.addEventListener('change', function (event) {
            const newFiles = Array.from(event.target.files);

            newFiles.forEach((file) => {
                if (file.type.startsWith('image/')) {
                    storedFiles.push(file);

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewItem = document.createElement('div');
                        previewItem.classList.add('image-preview-item');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        previewItem.appendChild(img);

                        const removeButton = document.createElement('button');
                        removeButton.classList.add('remove-image-button');
                        removeButton.textContent = 'X';

                        removeButton.addEventListener('click', function () {
                            // Remove from storedFiles
                            storedFiles = storedFiles.filter((f) => f !== file);
                            // Remove from UI
                            previewContainer.removeChild(previewItem);
                            // Rebuild FileList
                            const dt = new DataTransfer();
                            storedFiles.forEach((f) => dt.items.add(f));
                            input.files = dt.files;
                        });

                        previewItem.appendChild(removeButton);
                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Update actual input.files
            const dt = new DataTransfer();
            storedFiles.forEach((f) => dt.items.add(f));
            input.files = dt.files;
        });

        // AJAX from submit
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // AJAX Form Submission
            $('#courseForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-message').text(''); // Clear previous errors

                const formData = new FormData(this);

                // Log FormData for debugging
                // for (let [key, value] of formData.entries()) {
                //     console.log(key, value);
                // }

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'Accept': 'application/json' // Ensure server returns JSON
                    },
                    success: function(response) {
                        // console.log('response', response);
                        alert(response.message);
                        resetForm(); // Reset the form
                    },
                    error: function(xhr) {
                        // console.log('error response', xhr.responseJSON);
                        const errors = xhr.responseJSON.errors || {};

                        // Handle CSRF token mismatch specifically
                        if (xhr.status === 419) {
                            alert('CSRF token not matched. Please refresh the page & try again.');
                            return;
                        }

                        for (const field in errors) {
                            // Convert Laravel's dot notation to bracket notation
                            let fieldName = field
                                .replace(/\.(\d+)\./g, '[$1].') // Convert .0. to [0].
                                .replace(/\.(\d+)$/, '[$1]')    // Convert .0 to [0]
                                .replace(/\.([a-zA-Z_]+)/g, '[$1]'); // Convert .title to [title]

                            // Escape special characters for jQuery selector
                            let escapedFieldName = fieldName.replace(/\./g, '\\.').replace(/\[/g, '\\[').replace(/\]/g, '\\]');
                            let $input = $(`[name="${escapedFieldName}"]`);

                            // Handle feature_image array
                            if (field.startsWith('feature_image')) {
                                $('#image-upload').next('.error-message').text(errors[field][0]);
                            } else if ($input.length) {
                                // For regular fields and module/content fields
                                $input.next('.error-message').text(errors[field][0]);
                            } else {
                                // Fallback: Log if field not found
                                console.warn('Field not found:', field, 'Converted:', fieldName);
                            }
                        }
                    }
                });
            });

            // Cancel button handler
            $('.cancel-btn').on('click', function() {
                resetForm();
            });
        });

        // Helper: Reset the form and dynamic fields
        function resetForm() {
            // Reset the form inputs
            $('#courseForm')[0].reset();
            
            // Clear image preview
            $('#image-preview-container').empty();
            
            // Reset dynamic modules and contents
            $('#modules').empty();
            moduleIndex = 0;
            contentCounters = { 0: 1 };
            
            // Add a single module with one content
            const moduleHtml = getModuleHtml(0);
            $('#modules').append(moduleHtml);
        }
    </script>
</body>
</html>
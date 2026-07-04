<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增履歷</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* 星星從左到右持續閃爍動畫 */
        @keyframes  star-blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .rating-stars:hover .fa-star {
            animation: star-blink 1s infinite;
        }
        /* 利用 nth-child 延遲，達到由左至右流動閃爍的效果 */
        .rating-stars .fa-star:nth-child(1) { animation-delay: 0.1s; }
        .rating-stars .fa-star:nth-child(2) { animation-delay: 0.2s; }
        .rating-stars .fa-star:nth-child(3) { animation-delay: 0.3s; }
        .rating-stars .fa-star:nth-child(4) { animation-delay: 0.4s; }
        .rating-stars .fa-star:nth-child(5) { animation-delay: 0.5s; }

        .star-input { cursor: pointer; color: #ccc; font-size: 1.5rem; transition: color 0.2s; }
        .star-input.checked, .star-input:hover, .star-input:hover ~ .star-input { color: #ffc107; }
        
        /* 整個框框都可以點擊拖曳的樣式 */
        .drag-item { 
            background: #f8f9fa; 
            margin-bottom: 15px; 
            padding: 15px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            position: relative; 
            cursor: grab; 
        }
        .drag-item:active {
            cursor: grabbing;
        }
        
        .error-msg { color: #dc3545; font-size: 0.875rem; margin-top: 5px; display: none; }
        
        /* 圖片預覽樣式 */
        .avatar-preview-container {
            width: 130px;
            height: 130px;
            border: 2px dashed #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            overflow: hidden;
        }
        .preview-avatar { width: 100%; height: 100%; object-fit: cover; display: none; }
        
        /* 作品縮圖預覽樣式 */
        .portfolio-preview-container {
            width: 100%;
            height: 100px;
            background: #eee;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .preview-portfolio { width: 100%; height: 100%; object-fit: cover; display: none; }

        /* 大標籤點擊摺疊樣式 */
        .section-toggle {
            cursor: pointer;
            user-select: none;
            background-color: #f1f7ff;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }
        .section-toggle:hover {
            background-color: #e2eeff;
        }
        .section-toggle .toggle-icon {
            transition: transform 0.2s;
        }
        /* 展開/收合時的箭頭旋轉效果 */
        .section-toggle[aria-expanded="false"] .toggle-icon {
            transform: rotate(-90deg);
        }
    </style>
</head>
<body class="bg-light py-5">

<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>新增個人履歷</h2>
        <a href="javascript:history.back();" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> 返回上一頁</a>
    </div>

    <form id="resumeForm" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="section-toggle d-flex align-items-center mb-3 text-primary" data-toggle="collapse" data-target="#basicInfoSection" aria-expanded="true">
            <h4 class="mb-0"><i class="fas fa-chevron-down toggle-icon mr-2"></i>基本資料</h4>
            <small class="text-muted ml-2">(點擊標籤可摺疊/展開)</small>
        </div>
        
        <div class="collapse show mb-5" id="basicInfoSection">
            <div class="row pt-2">
                <div class="col-md-3 border-right">
                    <div class="form-group text-center">
                        <label class="font-weight-bold text-muted d-block text-left">個人頭像 <span class="text-danger">*</span></label>
                        <div class="avatar-preview-container mx-auto mb-2">
                            <span id="avatarPlaceholder" class="text-muted small">尚未上傳</span>
                            <img id="avatarPreview" src="#" alt="頭像預覽" class="preview-avatar">
                        </div>
                        <input type="file" id="avatarInput" name="avatar" class="form-control-file" accept="image/*" data-rule="required_avatar" style="font-size: 12px;">
                        <div class="error-msg text-center">請上傳一張個人頭像</div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>履歷名稱 <span class="text-danger">*</span></label>
                            <input type="text" name="resume_name" class="form-control" data-rule="required">
                            <div class="error-msg">請輸入履歷名稱</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>姓名 <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" data-rule="required">
                            <div class="error-msg">請輸入姓名</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>性別 <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" data-rule="required">
                                <option value="">請選擇</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                                <option value="0">其他</option>
                            </select>
                            <div class="error-msg">請選擇性別</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>年齡 <span class="text-danger">*</span></label>
                            <input type="text" name="age" class="form-control" data-rule="age">
                            <div class="error-msg">請輸入正確的年齡 (1-3位數字)</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>婚姻狀態 <span class="text-danger">*</span></label>
                            <select name="marriage" class="form-control" data-rule="required">
                                <option value="">請選擇</option>
                                <option value="1">未婚</option>
                                <option value="0">已婚</option>
                            </select>
                            <div class="error-msg">請選擇婚姻狀態</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-4">
                    <label>畢業學校 <span class="text-danger">*</span></label>
                    <input type="text" name="school" class="form-control" data-rule="required">
                    <div class="error-msg">請輸入畢業學校</div>
                </div>
                <div class="form-group col-md-4">
                    <label>手機號碼 <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" data-rule="phone" placeholder="例如: 0912345678">
                    <div class="error-msg">請輸入正確的手機號碼格式 (台灣手機 10 碼)</div>
                </div>
                <div class="form-group col-md-4">
                    <label>電子信箱 <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" data-rule="email">
                    <div class="error-msg">請輸入正確的信箱格式</div>
                </div>
            </div>

            <div class="form-group">
                <label>個人簡介 <span class="text-danger">*</span></label>
                <textarea name="summary" class="form-control" rows="3" data-rule="required"></textarea>
                <div class="error-msg">請輸入個人簡介</div>
            </div>

            <div class="form-group">
                <label>求職簡介 <span class="text-danger">*</span></label>
                <textarea name="job_summary" class="form-control" rows="3" data-rule="required"></textarea>
                <div class="error-msg">請輸入求職簡介</div>
            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3 section-toggle text-primary" data-toggle="collapse" data-target="#experienceSection" aria-expanded="true">
                <h4 class="mb-0">
                    <i class="fas fa-chevron-down toggle-icon mr-2"></i>工作經歷 
                    <small class="text-muted" style="font-size: 60%;">(任選框內空白處即可上下拖曳排序 / 點擊標籤可折疊)</small>
                </h4>
                <button type="button" class="btn btn-sm btn-success" id="addExperience" onclick="event.stopPropagation();"><i class="fas fa-plus"></i> 新增經歷</button>
            </div>
            <div class="collapse show mb-5" id="experienceSection">
                <div id="experienceContainer" class="pt-2"></div>
            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3 section-toggle text-primary" data-toggle="collapse" data-target="#skillSection" aria-expanded="true">
                <h4 class="mb-0">
                    <i class="fas fa-chevron-down toggle-icon mr-2"></i>專業技能 
                    <small class="text-muted" style="font-size: 60%;">(任選框內空白處即可上下拖曳排序 / 點擊標籤可折疊)</small>
                </h4>
                <button type="button" class="btn btn-sm btn-success" id="addSkill" onclick="event.stopPropagation();"><i class="fas fa-plus"></i> 新增技能</button>
            </div>
            <div class="collapse show mb-5" id="skillSection">
                <div id="skillContainer" class="pt-2"></div>
            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3 section-toggle text-primary" data-toggle="collapse" data-target="#portfolioSection" aria-expanded="true">
                <h4 class="mb-0">
                    <i class="fas fa-chevron-down toggle-icon mr-2"></i>作品集 
                    <small class="text-muted" style="font-size: 60%;">(任選框內空白處即可上下拖曳排序 / 點擊標籤可折疊)</small>
                </h4>
                <button type="button" class="btn btn-sm btn-success" id="addPortfolio" onclick="event.stopPropagation();"><i class="fas fa-plus"></i> 新增作品</button>
            </div>
            <div class="collapse show mb-5" id="portfolioSection">
                <div id="portfolioContainer" class="pt-2"></div>
            </div>
        </div>

        <hr class="my-4">
        
        <div class="form-row">
            <div class="col-md-3 mb-2">
                <input type="hidden" name="resume_display" id="resume_display" value="0">
                <a href="javascript:history.back();" class="btn btn-secondary btn-lg btn-block">返回上一頁</a>
            </div>
            <div class="col-md-9 mb-2">
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitBtn">儲存履歷</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
$(document).ready(function() {

    // --- 1. 自動更新各動態區塊上方的 ID 序號 ---
    function refreshIDs(containerId, prefixCh) {
        $(`#${containerId} .drag-item`).each(function(index) {
            $(this).find('.item-id-badge').text(`ID ${prefixCh} ${index + 1}`);
        });
    }

    // --- 2. 初始化拖曳套件 (SortableJS) ---
    const sortableOptions = (containerId, prefixCh) => ({
        animation: 150,
        filter: "input, textarea, select, button, .star-input, i", 
        preventOnFilter: false, 
        onEnd: function() { refreshIDs(containerId, prefixCh); }
    });

    new Sortable(document.getElementById('experienceContainer'), sortableOptions('experienceContainer', '經歷'));
    new Sortable(document.getElementById('skillContainer'), sortableOptions('skillContainer', '技能'));
    new Sortable(document.getElementById('portfolioContainer'), sortableOptions('portfolioContainer', '作品'));

    // --- 3. 個人大頭貼即時預覽功能 ---
    $('#avatarInput').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#avatarPlaceholder').hide();
                $('#avatarPreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        }
    });

    // --- 4. 動態生成 HTML 模板（作品集內已調整為：縮圖在最前面） ---
    function createExperienceItem() {
        return `
            <div class="drag-item" data-type="experience">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge badge-info font-weight-bold item-id-badge">ID 經歷 計算中</span>
                    <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                    <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="experienceContainer" data-prefix="經歷">刪除</button>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>在職時間 <span class="text-danger">*</span></label>
                        <input type="text" name="exp_time[]" class="form-control" placeholder="如: 2024.01 - 2026.03" data-rule="required">
                        <div class="error-msg">請輸入在職時間</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>公司名稱 <span class="text-danger">*</span></label>
                        <input type="text" name="exp_company[]" class="form-control" data-rule="required">
                        <div class="error-msg">請輸入公司名稱</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>職稱 <span class="text-danger">*</span></label>
                        <input type="text" name="exp_title[]" class="form-control" data-rule="required">
                        <div class="error-msg">請輸入職稱</div>
                    </div>
                </div>
            </div>`;
    }

    function createSkillItem() {
        return `
            <div class="drag-item" data-type="skill">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge badge-success font-weight-bold item-id-badge">ID 技能 計算中</span>
                    <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                    <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="skillContainer" data-prefix="技能">刪除</button>
                </div>
                <div class="form-row align-items-center">
                    <div class="form-group col-md-3">
                        <label>類別 <span class="text-danger">*</span></label>
                        <select name="skill_category[]" class="form-control" data-rule="required">
                            <option value="">請選擇</option>
                            <option value="frontend">前端</option>
                            <option value="backend">後端</option>
                        </select>
                        <div class="error-msg">請選擇類別</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>技能名稱 <span class="text-danger">*</span></label>
                        <input type="text" name="skill_name[]" class="form-control" data-rule="required">
                        <div class="error-msg">請輸入技能名稱</div>
                    </div>
                    <div class="form-group col-md-5">
                        <label>熟練度 <span class="text-danger">*</span></label>
                        <div class="rating-stars d-flex align-items-center mt-2">
                            <i class="far fa-star star-input" data-value="1"></i>
                            <i class="far fa-star star-input" data-value="2"></i>
                            <i class="far fa-star star-input" data-value="3"></i>
                            <i class="far fa-star star-input" data-value="4"></i>
                            <i class="far fa-star star-input" data-value="5"></i>
                            <input type="hidden" name="skill_level[]" class="star-rating-val" data-rule="required_star">
                        </div>
                        <div class="error-msg">請選取熟練度</div>
                    </div>
                </div>
            </div>`;
    }

    function createPortfolioItem() {
        return `
            <div class="drag-item" data-type="portfolio">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge badge-warning font-weight-bold item-id-badge">ID 作品 計算中</span>
                    <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                    <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="portfolioContainer" data-prefix="作品">刪除</button>
                </div>
                
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="form-group">
                            <label>作品縮圖 <span class="text-danger">*</span></label>
                            <input type="file" name="portfolio_image[]" class="form-control-file portfolio-img-input" multiple accept="image/*" data-rule="required_portfolio_img" style="font-size: 12px;">
                            <div class="error-msg">請上傳作品縮圖</div>
                            <div class="mt-2 portfolio-preview-container">
                                <span class="text-muted small thumb-placeholder">暫無縮圖預覽</span>
                                <img src="#" alt="縮圖預覽" class="preview-portfolio">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>作品名稱 <span class="text-danger">*</span></label>
                                <input type="text" name="portfolio_title[]" class="form-control" data-rule="required">
                                <div class="error-msg">請輸入作品名稱</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>作品連結 <span class="text-danger">*</span></label>
                                <input type="text" name="portfolio_link[]" class="form-control" placeholder="https://..." data-rule="url">
                                <div class="error-msg">請輸入正確的網址格式</div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label>作品說明 <span class="text-danger">*</span></label>
                            <textarea name="portfolio_desc[]" class="form-control" rows="2" data-rule="required"></textarea>
                            <div class="error-msg">請輸入作品說明</div>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    // --- 5. 初始化頁面自動加載第一筆數據 ---
    $('#experienceContainer').append(createExperienceItem()); refreshIDs('experienceContainer', '經歷');
    $('#skillContainer').append(createSkillItem()); refreshIDs('skillContainer', '技能');
    $('#portfolioContainer').append(createPortfolioItem()); refreshIDs('portfolioContainer', '作品');

    // 新增按鈕
    $('#addExperience').click(function() { $('#experienceContainer').append(createExperienceItem()); refreshIDs('experienceContainer', '經歷'); });
    $('#addSkill').click(function() { $('#skillContainer').append(createSkillItem()); refreshIDs('skillContainer', '技能'); });
    $('#addPortfolio').click(function() { $('#portfolioContainer').append(createPortfolioItem()); refreshIDs('portfolioContainer', '作品'); });

    // 刪除按鈕
    $(document).on('click', '.remove-item', function() {
        const containerId = $(this).data('container');
        const prefixCh = $(this).data('prefix');
        $(this).closest('.drag-item').remove();
        refreshIDs(containerId, prefixCh);
    });

    // 作品縮圖獨立預覽處理
    $(document).on('change', '.portfolio-img-input', function() {
        const file = this.files[0];
        const $parent = $(this).closest('.form-group');
        const $previewImg = $parent.find('.preview-portfolio');
        const $placeholder = $parent.find('.thumb-placeholder');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $placeholder.hide();
                $previewImg.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        }
    });

    // 星星評分邏輯
    $(document).on('click', '.star-input', function() {
        const val = $(this).data('value');
        const $container = $(this).closest('.rating-stars');
        $container.find('.star-rating-val').val(val).trigger('change'); 
        
        $container.find('.star-input').each(function() {
            if ($(this).data('value') <= val) {
                $(this).removeClass('far').addClass('fas checked');
            } else {
                $(this).removeClass('fas checked').addClass('far');
            }
        });
    });

    // --- 6. 前端 jQuery 正則表達式驗證機制 ---
    const regexRules = {
        required: /.+/,
        age: /^[0-9]{1,3}$/,
        phone: /^09[0-9]{8}$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        url: /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/
    };

    $('#resumeForm').submit(function(e) {
        e.preventDefault();
        let isValid = true;

        $('[data-rule]').each(function() {
            const $input = $(this);
            const rule = $input.data('rule');
            const val = $input.val() ? $input.val().trim() : '';
            
            let $error = $input.siblings('.error-msg');
            if (rule === 'required_star') {
                $error = $input.closest('.rating-stars').siblings('.error-msg');
            }

            // A. 大頭貼驗證
            if (rule === 'required_avatar') {
                if ($input[0].files.length === 0) {
                    $error.show(); $input.addClass('is-invalid'); isValid = false;
                } else {
                    $error.hide(); $input.removeClass('is-invalid');
                }
                return;
            }

            // B. 作品縮圖驗證
            if (rule === 'required_portfolio_img') {
                if ($input[0].files.length === 0) {
                    $error.show(); $input.addClass('is-invalid'); isValid = false;
                } else {
                    $error.hide(); $input.removeClass('is-invalid');
                }
                return;
            }

            // C. 星星熟練度驗證
            if (rule === 'required_star') {
                if (val === '') {
                    $error.show(); isValid = false;
                } else {
                    $error.hide();
                }
                return;
            }

            // D. 一般文字正則驗證（涵蓋經歷時間、公司、職稱、類別、技能名稱、作品名稱、連結、說明）
            const regex = regexRules[rule];
            if (!regex || !regex.test(val)) {
                $error.show();
                $input.addClass('is-invalid');
                isValid = false;
                
                // 若出錯欄位剛好在收合區塊內，自動展開
                const $parentCollapse = $input.closest('.collapse');
                if ($parentCollapse.length && !$parentCollapse.hasClass('show')) {
                    $parentCollapse.collapse('show');
                }
            } else {
                $error.hide();
                $input.removeClass('is-invalid');
            }
        });

        if (!isValid) {
            $('html, body').animate({ scrollTop: $('.is-invalid, .error-msg:visible').first().offset().top - 100 }, 200);
            return false;
        }

        // 整理成 FormData 送往後端
        let formData = new FormData(this);
        $('#submitBtn').prop('disabled', true).text('儲存中...');

        $.ajax({
            url: '/verifydata', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('履歷儲存成功！');
                window.location.href = '/present/manage'; 
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).text('儲存履歷');
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    alert('後端驗證失敗：\n' + Object.values(errors).flat().join('\n'));
                } else {
                    alert('系統發生錯誤，請稍後再試。');
                }
            }
        });
    });
});
</script>
</body>
</html><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/present/resumeAdd.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改履歷</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* 星星從左到右持續閃爍動畫 */
        @keyframes star-blink {
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
        .preview-avatar-width { width: 65px; float:left; }
        .preview-avatar-show { width: 100%; height: 100%; object-fit: cover; display: block;color: rgb(23, 162, 184) !important;font-weight: 700 !important; }
        
        /* 作品縮圖預覽樣式 */
        /* .portfolio-preview-container {
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
        .preview-portfolio-width { width: 65px; float:left; }
        .preview-portfolio-show { width: 100%; height: 100%; object-fit: cover; display: block; } */

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
        /* 徹底隱藏原生 input file 及其自帶的灰色文字 */
        .file-input {
            position: absolute;
            top: 0; left: 0; width: 0; height: 0;
            opacity: 0; overflow: hidden; pointer-events: none;
        }
        /* 徹底隱藏原生 input file 及其自帶的灰色文字 */
        .avatar-file-input {
            position: absolute;
            top: 0; left: 0; width: 0; height: 0;
            opacity: 0; overflow: hidden; pointer-events: none;
        }

        /* 預覽視窗外框 */
        .preview-container {
            width: 130px;
            height: 130px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background-color: #f9f9f9;
            margin: 0 auto 10px auto;
        }

        /* 圖片滿版且不變形 */
        .image-preview {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0; left: 0;
        }

        /* 圖片滿版且不變形 */
        .avatar-image-preview {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0; left: 0;
        }

        /* 客製化按鈕 */
        .btn-select-file {
            display: inline-block;
            padding: 6px 14px;
            font-size: 13px;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-select-file:hover { background-color: #e9ecef; }

        .box-title { font-weight: bold; color: #6c757d; display: block; text-align: left; margin-bottom: 5px; }
        .placeholder-text { color: #adb5bd; font-size: 13px; }
        .avatar-placeholder-text { color: #adb5bd; font-size: 13px; }
        .filename-display { font-size: 11px; color: #6c757d; margin-top: 5px; word-break: break-all; }
        .avatar-filename-display { font-size: 11px; color: #6c757d; margin-top: 5px; word-break: break-all; }

        /* 膠囊按鈕外殼 */
.custom-switch-btn {
    position: relative;
    width: 80px;
    height: 38px;
    background-color: #6c757d; /* 預設「關」的顏色 (Bootstrap secondary) */
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    user-select: none;
}

/* 當激活（開）時，外殼變綠色 (Bootstrap success) */
.custom-switch-btn.active {
    background-color: #198754; 
}

/* 內部滑動的圓鈕 */
.custom-switch-btn .switch-circle {
    position: absolute;
    top: 4px;
    left: 4px;
    width: 30px;
    height: 30px;
    background-color: #ffffff;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* 當激活（開）時，圓鈕往右滑動 (80px 外殼 - 30px 圓鈕 - 4px 邊距 = 42px) */
.custom-switch-btn.active .switch-circle {
    transform: translateX(42px);
}

/* 文字共用樣式 */
.custom-switch-btn .switch-txt-on,
.custom-switch-btn .switch-txt-off {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    font-weight: bold;
    color: #ffffff;
    transition: opacity 0.2s ease;
}

/* 「開」字放在左邊，預設隱藏 */
.custom-switch-btn .switch-txt-on {
    left: 12px;
    opacity: 0;
}

/* 「關」字放在右邊，預設顯示 */
.custom-switch-btn .switch-txt-off {
    right: 12px;
    opacity: 1;
}

/* 狀態切換時的文字顯隱控制 */
.custom-switch-btn.active .switch-txt-on { opacity: 1; }
.custom-switch-btn.active .switch-txt-off { opacity: 0; }
    </style>
</head>
<body class="bg-light py-5">

<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>修改個人履歷</h2>
        <a href="/present/manage?page={{$page}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> 返回上一頁</a>
    </div>

    <form id="resumeForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- 隱藏方法欄位 --}}
        {{ method_field('PUT') }}
        {{-- CSRF 欄位 --}}
                {{ csrf_field() }}
        <div class="section-toggle d-flex align-items-center mb-3 text-primary" data-toggle="collapse" data-target="#basicInfoSection" aria-expanded="true">
            <h4 class="mb-0"><i class="fas fa-chevron-down toggle-icon mr-2"></i>基本資料</h4>
            <small class="text-muted ml-2">(點擊標籤可摺疊/展開)</small>
        </div>
        @php
            // 讀取舊資料，若無則給予預設圖或空字串
            $oldPic = old('resume_picme', $presents[0]->resume_picme);
            $previewUrl = $oldPic ? asset($oldPic) : asset('images/' . $oldPic); 
        @endphp
        @php
            $path = $presents[0]->resume_picme;

            // 直接撈出完整檔名
            $filename = pathinfo($path, PATHINFO_BASENAME);

            // 如果只要主檔名
            $pureName = pathinfo($path, PATHINFO_FILENAME);
            

            // 如果只要副檔名
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            

            $path=$pureName.'.'.$extension;
        @endphp
        
        <div class="collapse show mb-5" id="basicInfoSection">
            <div class="row pt-2">
                {{-- 💥 關鍵：用 data- 屬性備份後端傳回的圖片與檔名 --}}
                <div class="col-md-3 mb-4 avatar-upload-box border-right">
                    
                    <label class="font-weight-bold text-muted d-block text-left">個人頭像 <span class="text-danger">*</span></label>
          
                    <div class="preview-container">
                        {{-- 根據後端是否有舊檔案，決定初始顯示或隱藏 --}}
                        <span class="avatar-placeholder-text" style="{{ asset($presents[0]->resume_picme) ? 'display: none;' : '' }}">尚未上傳</span>
                        
                        <img class="avatar-image-preview" 
                            src="{{ asset($presents[0]->resume_picme) ? asset($presents[0]->resume_picme) : '' }}" 
                            alt="預覽圖" 
                            style="{{ asset($presents[0]->resume_picme) ? 'display: block;' : 'display: none;' }}">
                    </div>
                    
                    <!-- 客製化按鈕（原生 input 已被 CSS 隱藏） -->
                    <label class="btn-select-file" style="cursor: pointer; display: block; text-align: center; margin-top: 10px;">
                        <span class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-camera"></i> 選擇檔案
                        </span>
                        <input type="file" id="avatar-file-input" name="avatar" class="avatar-file-input" 
                        data-init-src="{{ $presents[0]->resume_picme ? asset($presents[0]->resume_picme) : '' }}" 
                    data-init-name="{{ $path ?? '未選擇任何檔案' }}" accept="image/*" data-rule="required_avatar" style="font-size: 12px;">
                        <!-- <input type="file" id="avatarInput" name="avatar" class="form-control-file" accept="image/*" data-rule="required_avatar" style="font-size: 12px;"> -->
                        <div class="error-msg text-center">請上傳一張個人頭像</div>
                    </label>
                    
                    <!-- 顯示檔名（初始顯示後端檔名） -->
                    <div class="avatar-filename-display">
                        {{ $path ?? '未選擇任何檔案' }}
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>履歷名稱 <span class="text-danger">*</span></label>
                            <input type="text" name="resume_name" class="form-control" value="{{ old('resume_name', $presents[0]->resume_name) }}" data-rule="required">
                            <div class="error-msg">請輸入履歷名稱</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>姓名 <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('resume_nickname', $presents[0]->resume_nickname) }}" data-rule="required">
                            <div class="error-msg">請輸入姓名</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>性別 <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" data-rule="required">
                                <option value="">請選擇</option>
                                @foreach($presents_sixes as $presents_six)
                                    <option value="{{ $presents_six->resume_six_id }}" @if(old('$presents_six->resume_six_id', $presents_six->resume_six_id) == $presents[0]->resume_sex ) selected @endif >{{ $presents_six->resume_sixname }}</option>
                                @endforeach
                            </select>
                            <div class="error-msg">請選擇性別</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>年齡 <span class="text-danger">*</span></label>
                            <input type="text" name="age" class="form-control" value="{{ old('resume_age', $presents[0]->resume_age) }}" data-rule="age">
                            <div class="error-msg">請輸入正確的年齡 (1-3位數字)</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>婚姻狀態 <span class="text-danger">*</span></label>
                            <select name="marriage" class="form-control" data-rule="required">
                                <option value="">請選擇</option>
                                @foreach($presents_marries as $presents_marry)
                                    <option value="{{ $presents_marry->resume_marry_id }}" @if(old('$presents_marry->resume_marry_id', $presents_marry->resume_marry_id) == $presents[0]->resume_marry ) selected @endif >{{ $presents_marry->resume_marry_name }}</option>
                                @endforeach
                            </select>
                            <div class="error-msg">請選擇婚姻狀態</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-4">
                    <label>畢業學校 <span class="text-danger">*</span></label>
                    <input type="text" name="school" class="form-control" value="{{ old('resume_education', $presents[0]->resume_education) }}" data-rule="required">
                    <div class="error-msg">請輸入畢業學校</div>
                </div>
                <div class="form-group col-md-4">
                    <label>手機號碼 <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('resume_cellphone', $presents[0]->resume_cellphone) }}" data-rule="phone" placeholder="例如: 0912345678">
                    <div class="error-msg">請輸入正確的手機號碼格式 (台灣手機 10 碼)</div>
                </div>
                <div class="form-group col-md-4">
                    <label>電子信箱 <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ old('resume_email', $presents[0]->resume_email) }}" data-rule="email">
                    <div class="error-msg">請輸入正確的信箱格式</div>
                </div>
            </div>

            <div class="form-group">
                <label>個人簡介 <span class="text-danger">*</span></label>
                <textarea name="summary" class="form-control" rows="3" data-rule="required">{{ old('resume_summary', $presents[0]->resume_summary) }}</textarea>
                <div class="error-msg">請輸入個人簡介</div>
            </div>

            <div class="form-group">
                <label>求職簡介 <span class="text-danger">*</span></label>
                <textarea name="job_summary" class="form-control" rows="3" data-rule="required">{{ old('resume_introduction', $presents[0]->resume_introduction) }}</textarea>
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
                <div id="experienceContainer" class="pt-2">
                    @foreach($resume_experience_decode as $index => $exp)
                    <div class="drag-item" data-type="experience">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-info font-weight-bold item-id-badge">ID 經歷 {{$index+1}}</span>
                            <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                            <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="experienceContainer" data-prefix="經歷">刪除</button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>在職時間 <span class="text-danger">*</span></label>
                                <input type="text" name="exp_time[]" value="{{ $exp['在職時間'] }}" class="form-control" placeholder="如: 2024.01 - 2026.03" data-rule="required">
                                <div class="error-msg">請輸入在職時間</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>公司名稱 <span class="text-danger">*</span></label>
                                <input type="text" name="exp_company[]" value="{{ $exp['公司'] }}" class="form-control" data-rule="required">
                                <div class="error-msg">請輸入公司名稱</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>職稱 <span class="text-danger">*</span></label>
                                <input type="text" name="exp_title[]" value="{{ $exp['職稱'] }}" class="form-control" data-rule="required">
                                <div class="error-msg">請輸入職稱</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
                <div id="skillContainer" class="pt-2">
                    @foreach($resume_skill_decode as $index => $skill)
                    <div class="drag-item" data-type="skill">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-success font-weight-bold item-id-badge">ID 技能 {{$index+1}}</span>
                            <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                            <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="skillContainer" data-prefix="技能">刪除</button>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-3">
                                <label>類別 <span class="text-danger">*</span></label>
                                @php 
                                if($skill['type']==='frontend'){
                                    $skill['type']='1';
                                }elseif($skill['type']==='backend'){
                                    $skill['type']='2';
                                } 
                                @endphp
                                <select name="skill_category[]" class="form-control" data-rule="required">
                                    <option value="">請選擇</option>
                                    
                                    @foreach($presents_skill_types as $presents_skill_type)
                                    
                                        <option value="{{ $presents_skill_type->resume_skill_type_name }}" @if(old('$presents_skill_type->resume_skill_type_id', $presents_skill_type->resume_skill_type_id) == $skill['type'] )selected @endif >

                                            @php if($presents_skill_type->resume_skill_type_name=="frontend"){
                                                echo '前端';
                                            }elseif($presents_skill_type->resume_skill_type_name=="backend"){
                                                echo '後端';
                                            }@endphp

                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-msg">請選擇類別</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>技能名稱 <span class="text-danger">*</span></label>
                                <input type="text" name="skill_name[]" class="form-control" value="{{ $skill['skill'] }}" data-rule="required">
                                <div class="error-msg">請輸入技能名稱</div>
                            </div>
                            <div class="form-group col-md-5">
                                <label>熟練度 <span class="text-danger">*</span></label>
                                <div class="rating-stars d-flex align-items-center mt-2">
                                    @php
                                        // 預設從資料庫抓取現有分數（例如 resume_six_id 對應的分數），若無則預設為 0
                                        $currentRating = $skill['trained'] ?? 0; 
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{-- 判斷目前資料庫的分數，決定預設要亮幾顆星 --}}
                                        <i class="far fa-star star-input {{ $i <= $currentRating ? 'checked fas' : '' }}" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="skill_level[]" value="{{ $skill['trained'] }}" class="star-rating-val" data-rule="required_star">
                                </div>
                                <div class="error-msg">請選取熟練度</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
                <div id="portfolioContainer" class="pt-2">
                    @foreach($resume_sideproject_decode as $index => $sideproject)
                    <div class="drag-item" data-type="portfolio">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-warning font-weight-bold item-id-badge">ID 作品 {{$index+1}}</span>
                            <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                            <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="portfolioContainer" data-prefix="作品">刪除</button>
                        </div>
                        @php
                            $portFolioPath = $sideproject['路徑'];
                            // 直接撈出完整檔名
                            $portFolioFilename = pathinfo($portFolioPath, PATHINFO_BASENAME);
                            // 如果只要主檔名
                            $portFolioPureName = pathinfo($portFolioPath, PATHINFO_FILENAME);
                            // 如果只要副檔名
                            $portFolioExtension = pathinfo($portFolioPath, PATHINFO_EXTENSION);
                            $portFolioPath = $portFolioPureName.'.'.$portFolioExtension;
                        @endphp
                        <div class="row">
                            {{-- 💥 關鍵：用 data- 屬性備份後端傳回的圖片與檔名 --}}
                            <div class="col-md-3 mb-4 upload-box border-right"
                                data-init-src="{{ $sideproject['路徑'] ? asset($sideproject['路徑']) : '' }}" 
                                data-init-name="{{ $sideproject['圖片名稱'] ?? '未選擇任何檔案' }}">
                                
                               
                                <label>作品縮圖 <span class="text-danger">*</span></label>
                                <div class="preview-container">
                                    {{-- 根據後端是否有舊檔案，決定初始顯示或隱藏 --}}
                                    <span class="placeholder-text" style="{{ asset($sideproject['路徑']) ? 'display: none;' : '' }}">尚未上傳</span>
                                    <label>作品縮圖 <span class="text-danger">*</span></label>
                                    <img class="image-preview" 
                                        src="{{ asset($sideproject['路徑']) ? asset($sideproject['路徑']) : '' }}" 
                                        alt="預覽圖" 
                                        style="{{ asset($sideproject['路徑']) ? 'display: block;' : 'display: none;' }}">
                                </div>
                                
                                <!-- 客製化按鈕（原生 input 已被 CSS 隱藏） -->
                                <label class="btn-select-file" style="cursor: pointer; display: block; text-align: center; margin-top: 10px;"">
                                    <span class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-camera"></i> 選擇檔案
                                    </span>
                                    <input type="file" name="portfolio_image[]" class="file-input" accept="image/*" data-rule="required_portfolio_img" style="font-size: 12px;">
                                </label>
                                
                                <!-- 顯示檔名（初始顯示後端檔名） -->
                                <div class="filename-display text-muted text-center ">
                                    {{ $portFolioPath ?? '未選擇任何檔案' }}
                                </div>
                            </div>
                            
                            <div class="col-md-9">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>作品名稱 <span class="text-danger">*</span></label>
                                        <input type="text" name="portfolio_title[]" class="form-control" value="{{ $sideproject['圖片名稱'] }}" data-rule="required">
                                        <div class="error-msg">請輸入作品名稱</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>作品連結 <span class="text-danger">*</span></label>
                                        <input type="text" name="portfolio_link[]" class="form-control" placeholder="https://..." value="{{ $sideproject['連結'] }}" data-rule="url">
                                        <div class="error-msg">請輸入正確的網址格式</div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>作品說明 <span class="text-danger">*</span></label>
                                    <textarea name="portfolio_desc[]" class="form-control" rows="2" data-rule="required">{{ $sideproject['說明'] }}</textarea>
                                    <div class="error-msg">請輸入作品說明</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="card p-4 shadow-sm" style="max-width: 400px;">
                <h5 class="card-title mb-4">預設開啟此履歷</h5>
                
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold">開啟狀態：</span>

                    <!-- 先放一個 0 的預設值 -->
                    <!-- <input type="hidden" name="resume_display" value="0"> -->
                    
                    <!-- 隱藏的 Input，用來記錄真正的狀態並傳給後端 -->
                    <input type="checkbox" id="statusCheckbox" name="resume_display" value="1" class="d-none" data-rule="required" 
                        data-id="{{ $presents[0]->resume_id ?? 1 }}" 
                        {{ ($presents[0]->resume_display ?? 0) ? 'checked' : '' }} >

                    <!-- 自訂的「左右切換膠囊按鈕」 -->
                    <div id="btnSwitch" class="custom-switch-btn {{ ($presents[0]->resume_display ?? 0) ? 'active' : '' }}">
                        <span class="switch-txt-on">是</span>
                        <span class="switch-txt-off">否</span>
                        <div class="switch-circle"></div> <!-- 左右滑動的圓鈕 -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Laravel CSRF Token (AJAX 必備) -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <hr class="my-4">
        
        <div class="form-row">
            <div class="col-md-3 mb-2">
                <input type="hidden" name="resume_display" id="resume_display" value="{{ $presents[0]->resume_display }}">
                <input type="hidden" name="resume_id" id="resume_id" value="{{ $presents[0]->resume_id }}">
                <div href="/present/manage?page={{$page}}" id="btnReback" class="btn btn-secondary btn-lg btn-block">返回上一頁</div>
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

<!-- 引入 SweetAlert2 CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // 針對所有設定了 data-rule="required" 的 input 和 select
    // 文字框用 input 監聽，下拉選單與檔案上傳用 change 監聽
    $(document).on('input change','input[data-rule="required"], input[data-rule="age"], input[data-rule="phone"], input[data-rule="email"], input[data-rule="required_star"], input[data-rule="url"], select[data-rule="required"], textarea[data-rule="required"]', function() {
        let $el = $(this);
        let $error = $el.siblings('.error-msg');
        let value = $el.val();

        // 判斷是否有值 (文字框、下拉選單都適用)
        // 如果是 file input，則判斷 files.length
        let hasValue = false;
        if ($el.attr('type') === 'file') {
            hasValue = $el[0].files.length > 0;
        } else {
            hasValue = value !== null && value.trim() !== '';
        }

        // 根據檢查結果顯示或隱藏
        if (hasValue) {
            $error.hide();
            $el.removeClass('is-invalid');
        }
    });
    
    $('#btnSwitch').click(function() {
        
        const $btn = $(this);
        const $checkbox = $('#statusCheckbox');
        
        // return;
        // 1. 切換按鈕的 active 樣式 (觸發 CSS 左右滑動)
        $btn.toggleClass('active');
        
        // 2. 同步更新隱藏 checkbox 的狀態
        const isChecked = $btn.hasClass('active');
        $checkbox.prop('checked', isChecked);

        // 3. (選擇性) 觸發 change 事件，方便其他驗證套件捕捉
        $('#statusCheckbox').trigger('change');
        
        // 準備送往後端的資料
        const statusValue = isChecked ? 1 : 0;
        const dataId = $checkbox.data('id');
        // 3. 發送 AJAX 給 Laravel
        // $.ajax({
        //     url: '/verifydata3',
        //     type: 'POST',
        //     data: {
        //         id: dataId,
        //         resume_display: statusValue
        //     },
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     success: function(response) {
        //         if (response.success) {
        
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: '設定已儲存！',
        //                 showConfirmButton: false,
        //                 timer: 1500,
        //                  position: 'top-end',      // (可選) 想要像通知一樣彈在右上角可以加這行
        //                 toast: true               // (可選) 變成精簡的小型土司樣式
        //             })
        //                 // Swal 倒數結束、關閉視窗後，才會執行這裡的跳轉
        //                 window.location.href = '/present/{{$presents[0]->resume_id}}/edit'; 
                    
                    
        //         }
        //     },
        //     error: function(xhr) {
        //         console.error(xhr.responseText);
        //         alert('網路錯誤，無法完成設定。');
        //     }
        // });
    });

    $('#btnReback').click(function() {
        {{-- 檢查 $presents 集合內，resume_display 是否完全沒有 1 --}}
        
        // 💡 修正點：同時檢查 prop('checked') 或 val() == '1'，雙重保障
        var isChecked = $('#statusCheckbox').prop('checked') || ($('#statusCheckbox').val() == '0');
        var idBtnValue = $('#statusCheckbox').data('id');

        // 自動動態取得目前網址的 page 參數，若沒有則預設為 4 (或 1)
        var urlParams = new URLSearchParams(window.location.search);
        var targetPage = urlParams.get('page') || {{$page}};

        @if(!$presents_all->contains('resume_display', 1))
        // 依據勾選狀態決定彈窗的內文
        var textMsg = isChecked 
            ? '目前沒有任何預設開啟的履歷，但已選擇開啟履歷按鈕，請問是否要將此履歷設為預設開啟？'
            : '目前沒有任何預設開啟的履歷，<br>同時也尚未選擇開啟履歷按鈕，<br>請問是否要將此履歷設為預設開啟？';
        @else
        // 依據勾選狀態決定彈窗的內文
        var textMsg = isChecked 
            ? '目前已選擇開啟履歷按鈕，請問是否要將此履歷設為預設開啟？'
            : '目前尚未選擇開啟履歷按鈕，<br>請問是否要將此履歷設為預設開啟？';
        @endif

        Swal.fire({
            icon: 'warning',
            title: '尚未設定預設履歷',
            html: textMsg,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '是的，開啟此履歷',
            cancelButtonText: '暫時不要'
        }).then((result) => {
            if (result.isConfirmed) {
                // 觸發切換按鈕點擊
                if ($('#btnSwitch').length) {
                    $('#btnSwitch').trigger('click'); 
                } else {
                    console.log('找不到 #btnSwitch 元素！');
                }

                // 發送 AJAX 請求
                $.ajax({
                    url: '/verifydata3',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: idBtnValue,
                        resume_display: 1
                    },
                    success: function(response) {
                        Swal.fire('已開啟！', '此履歷已設定為預設開啟。', 'success')
                            .then(() => {
                                window.location.href = '/present/manage?page=' + targetPage;
                            });
                    }
                });
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: '繼續返回上一頁?',
                    html: textMsg,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '是的，返回上一頁吧!',
                    cancelButtonText: '先等等'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/present/manage?page=' + targetPage;
                    }
                });
            }
        });
    });

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

    var $fileInput = $('#avatar-file-input');
    var initAvatarSrc = $fileInput.data('init-src');   // 撈出後端舊圖網址
    var initAvatarName = $fileInput.data('init-name'); // 撈出後端舊檔名

    // ─── 步驟 一：初始化，將後端資料注入為真實的 files[0] ───
    if (initAvatarSrc) {
        fetch(initAvatarSrc)
            .then(function(response) {
                return response.blob(); // 將圖片轉為 Blob 數據流
            })
            .then(function(blob) {
                // 將 Blob 封裝成標準的 JavaScript File 物件
                var file = new File([blob], initAvatarName, { type: blob.type });

                // 💥 業界黑魔法：利用 DataTransfer 容器繞過 input files 的唯讀限制
                var dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                // 正式將偽裝好的 File 物件塞進 jQuery 的 input 元素中
                $fileInput[0].files = dataTransfer.files;

                // 測試：現在你可以檢查它，裡面真的有後端資料的 File 物件了！
                console.log("預設資料注入成功：", $fileInput[0].files[0]);
            })
            .catch(function(error) {
                console.error("後端圖片轉換失敗:", error);
            });
    }

    // ─── 步驟 二：使用者點擊變更時的「即時預覽」與「取消還原」 ───
    $fileInput.on('change', function(e) {
        var file = e.target.files[0];
        
        if (file) {
            // 使用者選了新檔案，更新預覽圖與檔名
            var objectURL = URL.createObjectURL(file);
            $('.avatar-image-preview').attr('src', objectURL).show();
            $('.avatar-placeholder-text').hide();
            $('.avatar-filename-display').text(file.name);
        } else {
            // 💥 使用者點了取消：因為步驟一已經把舊圖塞進 files[0] 了，
            // 點取消只會讓 input 變空，所以這裡我們要「重新觸發一次初始化」讓它塞回去
            if (initAvatarSrc) {
                location.reload(); // 最簡單暴力的還原法，或是把步驟一封裝成 function 重呼叫一次
            }
        }
    });
    // --- 3. 個人大頭貼即時預覽功能 ---
    // $('.avatar-file-input').on('change', function (e) {
    //     // 1. 鎖定當前操作的這「一組」容器
    //     var $currentAvatarBox = $(this).closest('.avatar-upload-box');
    //     var file = e.target.files[0]; 

    //     // 從該組的 data- 屬性中，讀取 Laravel 渲染時備份的「初始後端資料」
    //     var initAvatarSrc = $currentAvatarBox.data('init-avatar-src');
    //     var initAvatarName = $currentAvatarBox.data('init-avatar-name');
    //     // var idx = $(this).index();
    //     if (file) {

    //         // 建立瀏覽器的暫存預覽網址
    //         var objectURL = URL.createObjectURL(file);
            
    //         // 操控當前組：塞入新圖網址並顯示
    //         $currentAvatarBox.find('.avatar-image-preview').attr('src', objectURL).show(); 
    //         $currentAvatarBox.find('.avatar-placeholder-text').hide();

    //         // 更新為新選的檔名（加綠色加粗識別）
    //         $currentAvatarBox.find('.avatar-filename-display')
    //             .html('新選擇：<span style="color: #28a745; font-weight: bold;">' + file.name + '</span>');

    //         // 效能優化：圖片載入後釋放暫存記憶體
    //         $currentAvatarBox.find('.avatar-image-preview').on('load', function() {
    //             URL.revokeObjectURL(objectURL);
    //         });
    //     // 🔴 情況二：使用者點了換圖，但最後按「取消」（未選取任何檔案）
    //     } else {
    //         // 檢查這筆資料「當初後端有沒有舊圖」
    //         if (initAvatarSrc) {
    //             // 恢復為後端的舊圖片與顯示狀態
    //             $currentAvatarBox.find('.avatar-image-preview').attr('src', initAvatarSrc).show();
    //             $currentAvatarBox.find('.avatar-placeholder-text').hide();
    //             // 恢復為後端的舊檔名（加藍色識別）
    //             $currentAvatarBox.find('.avatar-filename-display')
    //                 .html('目前檔案：<span style="color: #17a2b8; font-weight: bold;">' + initAvatarName + '</span>');
    //         } else {
    //             // 如果當初後端就完全沒資料，就徹底隱藏歸零
    //             $currentAvatarBox.find('.avatar-image-preview').attr('src', '').hide();
    //             $currentAvatarBox.find('.avatar-placeholder-text').show();
    //             $currentAvatarBox.find('.avatar-filename-display').html('<span style="color: #6c757d;">未選擇任何檔案</span>');
    //         }
    //     }
    // });

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
                <!-- ID 會由你的 refreshIDs 函式去更新，這裡給個預設字樣即可 -->
                <span class="badge badge-warning font-weight-bold item-id-badge">ID 作品</span>
                <small class="text-muted ml-2"><i class="fas fa-arrows-alt-v"></i> 點擊此框內任意區域即可拖曳</small>
                <button type="button" class="btn btn-sm btn-danger ml-auto remove-item" data-container="portfolioContainer" data-prefix="作品">刪除</button>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4 upload-box border-right" data-init-src="" data-init-name="未選擇任何檔案">
                    
                    <div class="preview-container" style="/*position: relative; width: 100%; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #f8f9fa;*/">
                        <!-- 預設顯示尚未上傳 -->
                        <span class="placeholder-text" style="color: #6c757d;">尚未上傳</span>
                        
                        <!-- 預覽圖先隱藏 (注意：加上了 class 'image-preview') -->
                        <img class="image-preview" src="" alt="預覽圖" style="display: none; /*max-width: 100%; max-height: 100%; object-fit: contain;*/">
                    </div>
                    
                    <!-- 客製化按鈕 -->
                    <label class="btn-select-file" style="cursor: pointer; display: block; text-align: center; margin-top: 10px;">
                        <span class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-camera"></i> 選擇檔案
                        </span>
                        <input type="file" name="portfolio_image[]" class="file-input" accept="image/*" data-rule="required_portfolio_img" style="display: none;">
                    </label>
                    
                    <!-- 顯示檔名 -->
                    <div class="filename-display text-muted text-center" style="font-size: 11px; margin-top: 5px; word-break: break-all;">
                        未選擇任何檔案
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>作品名稱 <span class="text-danger">*</span></label>
                            <input type="text" name="portfolio_title[]" class="form-control" value="" data-rule="required">
                            <div class="error-msg" style="display: none; color: red; font-size: 12px;">請輸入作品名稱</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>作品連結 <span class="text-danger">*</span></label>
                            <input type="text" name="portfolio_link[]" class="form-control" placeholder="https://..." value="" data-rule="url">
                            <div class="error-msg" style="display: none; color: red; font-size: 12px;">請輸入正確的網址格式</div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label>作品說明 <span class="text-danger">*</span></label>
                        <textarea name="portfolio_desc[]" class="form-control" rows="2" data-rule="required"></textarea>
                        <div class="error-msg" style="display: none; color: red; font-size: 12px;">請輸入作品說明</div>
                    </div>
                </div>
            </div>
        </div>`;
}

// 監聽整個 container 底下所有 file input 的變更事件 (支援動態新增元素)
    $('#portfolioContainer').on('change', '.file-input', function() {
        const input = this;
        const $uploadBox = $(input).closest('.upload-box');
        const $previewImg = $uploadBox.find('.image-preview');
        const $placeholder = $uploadBox.find('.placeholder-text');
        const $filenameDisplay = $uploadBox.find('.filename-display');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // 1. 產生即時預覽 URL
            const previewUrl = URL.createObjectURL(file);
            
            // 2. 顯示圖片、隱藏「尚未上傳」文字
            $previewImg.attr('src', previewUrl).show();
            $placeholder.hide();
            
            // 3. 更新顯示的檔案名稱
            $filenameDisplay.text(file.name);
            
        } else {
            // 防呆：如果使用者點了取消、沒有選檔案，就復原為初始狀態
            const initSrc = $uploadBox.data('init-src');
            const initName = $uploadBox.data('init-name') || '未選擇任何檔案';
            
            if (initSrc) {
                $previewImg.attr('src', initSrc).show();
                $placeholder.hide();
            } else {
                $previewImg.attr('src', '').hide();
                $placeholder.show();
            }
            $filenameDisplay.text(initName);
        }
    });

    // --- 5. 初始化頁面自動加載第一筆數據 ---
    // $('#experienceContainer').append(createExperienceItem()); refreshIDs('experienceContainer', '經歷');
    // $('#skillContainer').append(createSkillItem()); refreshIDs('skillContainer', '技能');
    // $('#portfolioContainer').append(createPortfolioItem()); refreshIDs('portfolioContainer', '作品');

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

    // ─── 步驟 一：利用迴圈，獨立為每筆有舊圖的 input 注入 File 物件 ───
    $('.upload-box').each(function() {
        var $box = $(this);
        var initSrc = $box.data('init-src');   // 撈出該筆舊圖網址
        var initName = $box.data('init-name'); // 撈出該筆舊檔名

        if (initSrc) {
            fetch(initSrc)
                .then(function(response) {
                    return response.blob();
                })
                .then(function(blob) {
                    // 封裝成標準的 File 物件
                    var file = new File([blob], initName, { type: blob.type });

                    // 使用 DataTransfer 繞過唯讀限制
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);

                    // 💥 精準找到「當前這一組」的原生 input，將檔案塞入
                    $box.find('.file-input')[0].files = dataTransfer.files;

                    console.log("成功為區塊注入預設檔案：", initName);
                })
                .catch(function(error) {
                    console.error("下載圖片失敗:", error);
                });
        }
    });

    // ─── 步驟 二：使用者手動更換圖片時的即時預覽 ───
    $('.file-input').on('change', function(e) {
        var $currentBox = $(this).closest('.upload-box');
        var file = e.target.files[0];
        
        var initSrc = $currentBox.data('init-src');
        var initName = $currentBox.data('init-name');

        if (file) {
            // 使用者選了新檔案
            var objectURL = URL.createObjectURL(file);
            $currentBox.find('.image-preview').attr('src', objectURL).show();
            $currentBox.find('.placeholder-text').hide();
            $currentBox.find('.filename-display')
                .html('新選擇：<span style="color: #28a745; font-weight: bold;">' + file.name + '</span>');
        } else {
            // 使用者點了更換又按取消
            // 因為取消會清空 input 的 files，此時最保險的做法是重新載入頁面還原
            if (initSrc) {
                location.reload(); 
            }
        }
    });

    
    // 作品縮圖獨立預覽處理
    // $('.file-input').on('change', function (e) {
    //     // 1. 鎖定當前操作的這「一組」容器
    //     var $currentBox = $(this).closest('.upload-box');
    //     var file = e.target.files[0]; 

    //     // 從該組的 data- 屬性中，讀取 Laravel 渲染時備份的「初始後端資料」
    //     var initSrc = $currentBox.data('init-src');
    //     var initName = $currentBox.data('init-name');
    //     // var idx = $(this).index();
    //     if (file) {

    //         // 建立瀏覽器的暫存預覽網址
    //         var objectURL = URL.createObjectURL(file);
            
    //         // 操控當前組：塞入新圖網址並顯示
    //         $currentBox.find('.image-preview').attr('src', objectURL).show(); 
    //         $currentBox.find('.placeholder-text').hide();

    //         // 更新為新選的檔名（加綠色加粗識別）
    //         $currentBox.find('.filename-display')
    //             .html('新選擇：<span style="color: #28a745; font-weight: bold;">' + file.name + '</span>');

    //         // 效能優化：圖片載入後釋放暫存記憶體
    //         $currentBox.find('.image-preview').on('load', function() {
    //             URL.revokeObjectURL(objectURL);
    //         });
    //     // 🔴 情況二：使用者點了換圖，但最後按「取消」（未選取任何檔案）
    //     } else {
    //         // 檢查這筆資料「當初後端有沒有舊圖」
    //         if (initSrc) {
    //             // 恢復為後端的舊圖片與顯示狀態
    //             $currentBox.find('.image-preview').attr('src', initSrc).show();
    //             $currentBox.find('.placeholder-text').hide();
    //             // 恢復為後端的舊檔名（加藍色識別）
    //             $currentBox.find('.filename-display')
    //                 .html('目前檔案：<span style="color: #17a2b8; font-weight: bold;">' + initName + '</span>');
    //         } else {
    //             // 如果當初後端就完全沒資料，就徹底隱藏歸零
    //             $currentBox.find('.image-preview').attr('src', '').hide();
    //             $currentBox.find('.placeholder-text').show();
    //             $currentBox.find('.filename-display').html('<span style="color: #6c757d;">未選擇任何檔案</span>');
    //         }
    //     }
    // });

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

        formData.append('resume_display', $('#statusCheckbox').prop('checked') ? 1 : 0,);
        formData.append('resume_id', $('#statusCheckbox').data('id'));

        // 無論使用者有沒有換圖，這裡永遠抓得到檔案物件！
        formData.append('avatar', $('#avatar-file-input')[0].files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        
        // 巡檢每一筆 input，直接 append 進 FormData 
        $('.file-input').each(function() {
            var nameAttribute = $(this).attr('name'); // 例如 photos[1], photos[2]
            var fileObject = $(this)[0].files[0];    // 必定有值 (不論新舊)

            if (fileObject) {
                formData.append(nameAttribute, fileObject);
            }
        });
        
        $('#submitBtn').prop('disabled', true).text('儲存中...');

        $.ajax({
            url: '/verifydata2', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('履歷儲存成功！');
                window.location.href = '/present/{{$presents[0]->resume_id}}/edit'; 
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
{{-- 檢查 $presents 集合內，resume_display 是否完全沒有 1 --}}
@if(!$presents_all->contains('resume_display', 1))
    <script>
            Swal.fire({
                icon: 'warning',
                title: '尚未設定預設履歷',
                text: '目前沒有任何預設開啟的履歷，請問是否要將此履歷設為預設開啟？',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '是的，開啟此履歷',
                cancelButtonText: '等等，我想一下'
            }).then((result) => {
                if (result.isConfirmed) {
                    // 使用者點擊了「是的，開啟此履歷」
                    
                    // 作法 1：如果頁面上剛好有 toggle 按鈕，可以直接觸發 click 事件
                    // if ($('#btnSwitch').length && !$('#btnSwitch').hasClass('active')) {
                    //     $('#btnSwitch').click(); 
                    // }
                    
                    // 作法 2：或者是直接發送 AJAX 請求去後端更新狀態
                    
                    $.ajax({
                        url: '/verifydata3',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: '{{ $presents[0]->resume_id ?? 1 }}',
                            resume_display: 1
                        },
                        success: function(response) {
                            Swal.fire('已開啟！', '此履歷已設定為預設開啟。', 'success')
                                .then(() => location.reload());
                        }
                    });
                    
                }
            });
    </script>
@endif
</body>
</html>
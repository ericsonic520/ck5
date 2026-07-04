<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/present/manage"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				      <button type="button" class="btn btn-primary" title="{{ $title }}">{{ $title }}</button>
            </h3>

            <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fas fa-minus"></i></button>
	          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fas fa-times"></i></button>
	        </div>
        </div>
          <!-- /.card-header -->
        <div class="card-body">
            <form action="/present/{{$resume_id}}/resumeEditDeal" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              {{-- 隱藏方法欄位 --}}
              {{ method_field('PUT') }}

            <div class="container">
                <div class="form-group col-md-3">
                    <label for="resume_name">履歷名稱:</label>
                    <input class="form-control" type="text" name="resume_name" value="{{ old('resume_name', $presents[0]->resume_name) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_nickname">名字:</label>
                    <input class="form-control" type="text" name="resume_nickname" value="{{ old('resume_nickname', $presents[0]->resume_nickname) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_picme">圖片:</label>
                    <input type="file" name="resume_picme" value="{{ old('resume_picme', $presents[0]->resume_picme) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_sex">性別:</label>
                    <select name="resume_sex" id="resume_sex" class="form-control">
                        <option value="1" @if(old('resume_sex', $presents[0]->resume_sex)=='1') selected @endif>男</option>
                        <option value="0" @if(old('resume_sex', $presents[0]->resume_sex)=='0') selected @endif>女</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_age">年齡:</label>
                    <input class="form-control" type="text" name="resume_age" value="{{ old('resume_age', $presents[0]->resume_age) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_marry">婚姻:</label>
                    <select name="resume_marry" id="resume_marry" class="form-control">
                        <option value="1" @if(old('resume_marry', $presents[0]->resume_marry)=='1') selected @endif>已婚</option>
                        <option value="2" @if(old('resume_marry', $presents[0]->resume_marry)=='2') selected @endif>未婚</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_education">教育:</label>
                    <input class="form-control" type="text" name="resume_education" value="{{ old('resume_education', $presents[0]->resume_education) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_cellphone">手機:</label>
                    <input class="form-control" type="text" name="resume_cellphone" value="{{ old('resume_cellphone', $presents[0]->resume_cellphone) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_email">信箱:</label>
                    <input class="form-control" type="text" name="resume_email" value="{{ old('resume_email', $presents[0]->resume_email) }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="resume_summary">簡介:</label>
                    <textarea name="resume_summary" id="resume_summary" class="form-control">{{ old('resume_summary', $presents[0]->resume_summary) }}</textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_introduction">自我介紹:</label>
                    <input class="form-control" type="text" name="resume_introduction" value="{{ old('resume_introduction', $presents[0]->resume_introduction) }}">
                </div>
                <!-- <div class="form-group col-md-3">
                    <label for="resume_experience">經驗:</label>
                    <input class="form-control" type="text" name="resume_experience" value="{{ old('resume_experience', $presents[0]->resume_experience) }}">
                </div> -->

                <div class="form-group col-md-12">
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
                    <style>
                        /* body { font-family: Arial, sans-serif; padding: 40px; background: #f4f6f9; } */
                        /* .container { max-width: 700px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); } */
                        .skill-row{ display: flex; align-items: center; margin-bottom: 15px; background: #fafafa; padding: 10px; border-radius: 5px; border:1px solid #d6d6d6; margin-right:350px;}
                        .experience-row{ display: flex; align-items: center; margin-bottom: 15px; background: #fafafa; padding: 10px; border-radius: 5px; border:1px solid #d6d6d6; margin-right:165;}
                        .row-num { font-weight: bold; margin-right: 15px; width: 30px; color: #666; }
                        .skill-input,.experience-input{ flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-right: 15px; margin-left: 15px;}
                        
                        /* 星星評分樣式 */
                        .rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; margin-right: 15px; }
                        .rating input { display: none; }
                        .rating label { font-size: 24px; color: #ccc; cursor: pointer; transition: color 0.2s; padding: 0 2px; }
                        /* 滑過時：由右到左黃色閃爍 */
                        .rating label:hover,
                        .rating label:hover ~ label{
                            color: #f6e05e;
                            animation: yellow-blink 0.6s infinite alternate;
                        }
                        .rating input:checked ~ label { 
                            color: #f5b301; 
                            animation: none;
                        }

                        @keyframes yellow-blink {
                            from { opacity: 1; filter: drop-shadow(0 0 2px #ecc94b); }
                            to { opacity: 0.5; filter: drop-shadow(0 0 8px #f6e05e); }
                        }

                        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
                        .btn-add { background: #28a745; color: #fff!important; margin-bottom: 20px; }
                        .btn-submit { background: #007bff; color: #fff; width: 100%; font-size: 16px; margin-top: 20px; }
                        /* .btn-delete { background: #dc3545; color: #fff; padding: 5px 10px; font-size: 12px; } */
                    </style>
                    <label for="resume_experience">經驗:</label>
                    <!-- 動態經驗容器 -->
                    <div id="experiences-container">
                        @forelse($resume_experience_decode as $index => $experience)
                        <div class="experience-row">
                            <!-- 編號 (從 1 開始) -->
                            <!-- <span class="row-num">{{ $index + 1 }}</span> -->
                            <div class="item-header"><span class="badge num-label">經驗 #{{ $index + 1 }}</span></div>
                            <!-- 隱藏的 ID (用於修改舊資料，若無舊資料可留空) -->
                            <input type="hidden" name="resume_experience_decode[{{ $index }}][ID]" value="{{ $experience['ID'] ?? '' }}">
                            <!-- 在職時間 -->
                            <input type="text" name="resume_experience_decode[{{ $index }}][在職時間]" class="experience-input" value="{{ $experience['在職時間'] }}" placeholder="請輸入在職時間" required>
                            <!-- 公司 -->
                            <input type="text" name="resume_experience_decode[{{ $index }}][公司]" class="experience-input" value="{{ $experience['公司'] }}" placeholder="請輸入公司名稱" required>
                            <!-- 職稱 -->
                            <input type="text" name="resume_experience_decode[{{ $index }}][職稱]" class="experience-input" value="{{ $experience['職稱'] }}" placeholder="請輸入職稱" required>

        

                            <!-- 刪除按鈕 -->
                            <button type="button" class="btn btn-delete" onclick="removeRow(this)">移除</button>
                        </div>
                        @empty
                        <!-- 若原本沒資料，預設顯示一筆空白的 -->
                        <script> window.onload = function() { addExperienceRow(); }; </script>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-add" onclick="addExperienceRow()"><i class="fa-solid fa-plus"></i> 增加經驗</button>
            
                        
                    <script>
                        // 用來追蹤當前的陣列索引值，避免重複
                        let experienceIndex = {{ count($resume_experience_decode ?? []) }};

                        // 動態增加經驗欄位
                        function addExperienceRow() {
                            const container = document.getElementById('experiences-container');
                            
                            const row = document.createElement('div');
                            row.className = 'experience-row';

                            row.innerHTML = `
                                <div class="item-header"><span class="badge num-label">經驗 #${experienceIndex+1}</span></div>
                                <!-- 隱藏的 ID (用於修改舊資料，若無舊資料可留空) -->
                                <input type="hidden" name="resume_experience_decode[${experienceIndex}][ID]" value="${experienceIndex+1}">
                                <!-- 在職時間 -->
                                <input type="text" name="resume_experience_decode[${experienceIndex}][在職時間]" class="experience-input" placeholder="請輸入在職時間" required>
                                <!-- 公司 -->
                                <input type="text" name="resume_experience_decode[${experienceIndex}][公司]" class="experience-input" placeholder="請輸入公司" required>
                                <!-- 職稱 -->
                                <input type="text" name="resume_experience_decode[${experienceIndex}][職稱]" class="experience-input" placeholder="請輸入職稱" required>

                                <button type="button" class="btn btn-delete" onclick="removeRow(this)">移除</button>
                            `;
                            
                            container.appendChild(row);
                            experienceIndex++;
                            
                            // 重新計算編號
                            updateRowNumbers();
                        }

                        // 刪除欄位
                        function removeRow(button) {
                            const row = button.parentElement;
                            row.remove();
                            updateRowNumbers();
                        }

                        // 重新排序編號數字
                        function updateRowNumbers() {
                            const rows = document.querySelectorAll('.experience-row');
                            rows.forEach((row, index) => {
                                row.querySelector('.row-num').innerText = index + 1;
                            });
                        }
                    </script>
                    
                </div>
                <div class="form-group col-md-12">                  
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
                    <style>
                        /* body { font-family: Arial, sans-serif; padding: 40px; background: #f4f6f9; } */
                        /* .container { max-width: 700px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); } */
                        .skill-row{ display: flex; align-items: center; margin-bottom: 15px; background: #fafafa; padding: 10px; border-radius: 5px; border:1px solid #d6d6d6; margin-right:350px;}
                        .experience-row{ display: flex; align-items: center; margin-bottom: 15px; background: #fafafa; padding: 10px; border-radius: 5px; border:1px solid #d6d6d6; margin-right:165px;}
                        .row-num { font-weight: bold; margin-right: 15px; width: 30px; color: #666; }
                        .skill-input { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-right: 15px; margin-left: 15px;}
                        
                        /* 星星評分樣式 */
                        .rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; margin-right: 15px; }
                        .rating input { display: none; }
                        .rating label { font-size: 24px; color: #ccc; cursor: pointer; transition: color 0.2s; padding: 0 2px; }
                        .rating label:hover,
                        .rating label:hover ~ label,
                        .rating input:checked ~ label { color: #f5b301; }

                        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
                        .btn-add { background: #28a745; color: #fff; margin-bottom: 20px; }
                        .btn-submit { background: #007bff; color: #fff; width: 100%; font-size: 16px; margin-top: 20px; }
                        /* .btn-delete { background: #dc3545; color: #fff; padding: 5px 10px; font-size: 12px; } */
                    </style>
                    <label for="resume_skill">技能:</label>
                    <!-- 動態技能容器 -->
                    <div id="skills-container">
                        @forelse($resume_skill_decode as $index => $skill)
                        <div class="skill-row">
                            <!-- 編號 (從 1 開始) -->
                            <!-- <span class="row-num">{{ $index + 1 }}</span> -->
                            <div class="item-header"><span class="badge num-label">技能 #{{ $index + 1 }}</span></div>
                            <!-- 隱藏的 ID (用於修改舊資料，若無舊資料可留空) -->
                            <input type="hidden" name="resume_skill_decode[{{ $index }}][id]" value="{{ $skill['id'] ?? '' }}">
                            
                            <select name="resume_skill_decode[{{ $index }}][type]" class="in-type form-control col-md-2">            
                                <option value="frontend" @if(old('resume_skill_decode[{{ $index }}][type]',  $skill['type'] )=='frontend') selected @endif>前端技能</option>
                                <option value="backend" @if(old('resume_skill_decode[{{ $index }}][type]',  $skill['type'] )=='backend') selected @endif>後端技能</option>
                            </select>

                            <!-- 技能名稱 -->
                            <input type="text" name="resume_skill_decode[{{ $index }}][skill]" class="skill-input" value="{{ $skill['skill'] }}" placeholder="請輸入技能名稱" required>

                            <!-- 星星熟練度 (1-5星) -->
                            <div class="rating">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star_{{ $index }}_{{ $i }}" name="resume_skill_decode[{{ $index }}][trained]" value="{{ $i }}" {{ $skill['trained'] == $i ? 'checked' : '' }} required>
                                    <label for="star_{{ $index }}_{{ $i }}"><i class="fa-solid fa-star"></i></label>
                                @endfor
                            </div>

                            <!-- 刪除按鈕 -->
                            <button type="button" class="btn btn-delete" onclick="removeRow(this)">移除</button>
                        </div>
                        @empty
                        <!-- 若原本沒資料，預設顯示一筆空白的 -->
                        <script> window.onload = function() { addSkillRow(); }; </script>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-add" onclick="addSkillRow()"><i class="fa-solid fa-plus"></i> 增加技能</button>
            
                        
                    <script>
                        // 用來追蹤當前的陣列索引值，避免重複
                        let skillIndex = {{ count($resume_skill_decode ?? []) }};

                        // 動態增加技能欄位
                        function addSkillRow() {
                            const container = document.getElementById('skills-container');
                            
                            const row = document.createElement('div');
                            row.className = 'skill-row';
                            
                            // 產生 5 到 1 星的 Radio HTML
                            let starsHtml = '';
                            for(let i = 5; i >= 1; i--) {
                                starsHtml += `
                                    <input type="radio" id="star_${skillIndex}_${i}" name="resume_skill_decode[${skillIndex}][trained]" value="${i}" required>
                                    <label for="star_${skillIndex}_${i}"><i class="fa-solid fa-star"></i></label>
                                `;
                            }

                            row.innerHTML = `
                                <div class="item-header"><span class="badge num-label">技能 #${skillIndex+1}</span></div>
                                <input type="hidden" name="resume_skill_decode[${skillIndex}][id]" value="${skillIndex+1}">
                                <select name="resume_skill_decode[${skillIndex}][type]" class="in-type form-control col-md-2">            
                                    <option value="frontend" @if(old('resume_skill_decode[{{ $index }}][type]',  $skill['type'] )=='frontend') selected @endif>前端技能</option>
                                    <option value="backend" @if(old('resume_skill_decode[{{ $index }}][type]',  $skill['type'] )=='backend')  @endif>後端技能</option>
                                </select>
                                <input type="text" name="resume_skill_decode[${skillIndex}][skill]" class="skill-input" placeholder="請輸入技能名稱" required>
                                <div class="rating">
                                    ${starsHtml}
                                </div>
                                <button type="button" class="btn btn-delete" onclick="removeRow(this)">移除</button>
                            `;
                            
                            container.appendChild(row);
                            skillIndex++;
                            
                            // 重新計算編號
                            updateRowNumbers();
                        }

                        // 刪除欄位
                        function removeRow(button) {
                            const row = button.parentElement;
                            row.remove();
                            updateRowNumbers();
                        }

                        // 重新排序編號數字
                        function updateRowNumbers() {
                            const rows = document.querySelectorAll('.skill-row');
                            rows.forEach((row, index) => {
                                row.querySelector('.row-num').innerText = index + 1;
                            });
                        }
                    </script>
                        
                </div>
                
                <style>
                    /* resources/css/app.css */
                    .item-card { border: 1px solid #e2e8f0; padding: 1.5rem; margin-bottom: 1rem; border-radius: 8px; background: #fff; position: relative; transition: 0.3s; }
                    .badge { background: #3182ce; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 0.85em;margin-right:10px }
                    .btn-delete { color: #e53e3e; cursor: pointer; float: right; font-weight: bold; border: 1px solid #e53e3e; padding: 2px 8px; border-radius: 4px; }
                    .btn-delete:hover { background: #e53e3e; color: #fff; }

                    /* 星星評分系統 */
                    .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 5px; }
                    .star-rating input { display: none; }
                    .star-rating label { font-size: 2.5rem; color: #cbd5e0; cursor: pointer; transition: 0.2s; }
                    .star-rating label::before { content: '★'; }

                    /* 滑過時：由右到左黃色閃爍 */
                    .star-rating label:hover,
                    .star-rating label:hover ~ label {
                        color: #f6e05e;
                        animation: yellow-blink 0.6s infinite alternate;
                    }

                    /* 選取後：保持深黃色並停止閃爍 */
                    .star-rating input:checked ~ label {
                        color: #ecc94b;
                        animation: none;
                    }

                    @keyframes yellow-blink {
                        from { opacity: 1; filter: drop-shadow(0 0 2px #ecc94b); }
                        to { opacity: 0.5; filter: drop-shadow(0 0 8px #f6e05e); }
                    }
                </style>
                
                <div class="form-group col-md-3">
                    <label for="resume_sideproject">作品:</label>
                    <input class="form-control" type="text" name="resume_sideproject" value="{{ old('resume_sideproject', $presents[0]->resume_sideproject) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="resume_display">是否選用</label>
                    <select name="resume_display" id="resume_display" class="form-control">
                        <option value="1" @if(old('resume_display', $presents[0]->resume_display)=='1') selected @endif>是</option>
                        <option value="0" @if(old('resume_display', $presents[0]->resume_display)=='0') selected @endif>否</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">更新</button>
            </div>

                
                

        

                
              </div>
          
                
                {{-- CSRF 欄位 --}}
                {{ csrf_field() }}
            </form>
        </div>
        <script type="text/javascript">
                $(document).ready(function() {
                    $('#summernote').summernote({
                        styleTags: [
            'p',
                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
        
                        // fontNames: ['Arial', 'Arial Black'],
                        // lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                        height: 400,
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['style','bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            // ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                            ['height', ['height']]
                        ]
                    })
                });
            </script>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
@endsection
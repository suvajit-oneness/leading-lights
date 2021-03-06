    <style>
        .desc {
            height: 340px !important;
        }
    </style>
    <!-- Modal for add question-->
    <div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examModalLabel">Add Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.addQuestion') }}" method="POST" enctype="multipart/form-data"
                        class="desc-question-form">
                        @csrf
                        <input type="hidden" name="exam_id" id="exam_id">
                        <div class="scroll_body desc">
                            <div id="dynamicAddRemove">
                                <p class="font-weight-bold text-center">Question No: 1</p>
                                <div class="form-group">
                                    <label for="question" class="font-weight-bold">Question<span
                                            class="text-danger">*</span></label>
                                    <textarea cols="2" name="addMoreInputFields[0][question]" rows="2"
                                        class="form-control h-auto"></textarea>
                                    <span class="textarea_error text-danger"></span>
                                </div>
                                <div class="form-group">

                                    <label for="image" class="font-weight-bold">Image</label>
                                    <input type="file" class="form-control-file" name="addMoreInputFields[0][image]">
                                    <span class="file_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="marks" class="font-weight-bold">Marks</label>
                                    <select id="marks" class="form-control" name="addMoreInputFields[0][marks]">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" name="add" id="dynamic-ar" class="btn btn-primary mt-3"><i
                                    class="fa fa-plus"></i> Add Question</button>
                            <button type="submit" class="btn btn-primary float-right mt-3" id="btnSubmit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

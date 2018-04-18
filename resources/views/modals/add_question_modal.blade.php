<!-- Add question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="profile-logo"><i class="fas fa-comment-dots"></i></span>Add Question</h4>
            </div>
            <form method="post" action={{url("/create")}}>
                {{ csrf_field() }}
                <div class="modal-body">
                    <label>Category</label>
                      <select name="category_id" class="form-control curve-edge">
                        <option value="1">General</option>
                        <option value="2">Science</option>
                        <option value="3">Sports</option>
                        <option value="4">Technology</option>
                        <option value="5">Arts</option>
                        <option value="6">History</option>
                        <option value="7">Funny</option>
                        <option value="8">Weird</option>
                      </select>
                    <label>Question</label>
                    <textarea class="form-control short-text" placeholder="Start your question with &quot;What&quot;, &quot;How&quot;, &quot;Why&quot;, etc." name="question"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary curve-edge main-button">Add Question</button>
                    <button type="button" class="btn btn-default curve-edge" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
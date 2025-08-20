@extends('dashboardmaster')

@section('title', 'Add Team Members')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Team Members</h3>
                </div>
                <form action="{{ route('dashboard.members.store') }}" method="POST" id="membersForm">
                    @csrf
                    <div class="card-body">
                        <div id="members-container">
                            <!-- Members will be added here dynamically -->
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-success" id="add-member">Add Member</button>
                            <button type="button" class="btn btn-info" id="add-bulk">Add 10 Members</button>
                            <span class="ml-3 text-muted">Members added: <span id="member-count">0</span></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Submit Members</button>
                        <a href="{{ route('dashboard.members') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let memberIndex = 0;
    const container = document.getElementById('members-container');
    const countSpan = document.getElementById('member-count');
    const submitBtn = document.getElementById('submit-btn');

    function addMember() {
        const memberDiv = document.createElement('div');
        memberDiv.className = 'row mb-2 member-row';
        memberDiv.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="members[${memberIndex}][name]" placeholder="Member Name" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="members[${memberIndex}][phone_number]" placeholder="Phone Number" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-member">Remove</button>
            </div>
        `;

        container.appendChild(memberDiv);
        memberIndex++;
        updateCount();
    }

    function updateCount() {
        const count = container.querySelectorAll('.member-row').length;
        countSpan.textContent = count;
        submitBtn.disabled = count < 1;
    }

    document.getElementById('add-member').addEventListener('click', addMember);

    document.getElementById('add-bulk').addEventListener('click', function() {
        for (let i = 0; i < 10; i++) {
            addMember();
        }
    });

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-member')) {
            e.target.closest('.member-row').remove();
            updateCount();
        }
    });

    // Add initial member
    addMember();
});
</script>
@endsection

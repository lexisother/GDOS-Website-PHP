@extends("layouts.app")

@section("content")
<div class="issue-container">
    <div class="issue-header">
        <div class="issue-meta">
            <div class="issue-meta-title">{{ $submission->title }}</div>
            <hr />
            <div class="issue-meta-desc">{{ $submission->description }}</div>
        </div>

        <div class="issue-data">
            @metaitem([
                "header" => "Creator",
                "content" => $submission->author_name,
                "image" => "/storage/uploads/avatars/" . $author->avatar,
                "imageAlt" => $submission->author_name . "'s profile picture",
            ])
            @endmetaitem

            @metaitem([
                "header" => "Creation date",
                "content" => $submission->created_at->toDateString(),
            ])
            @endmetaitem

            {{-- Assignees currently are not implemented (at all, they do not
            even exist on the ContactItem model), but perhaps it is something to consider in
            the future
            {issue.assignee ? (
                <MetaItem
                    header="Assignee"
                    content={issue.assignee.name}
                    image={issue.assignee.avatarUrl}
                    imageAlt={`${issue.assignee.name}'s profile picture`}
                />
            ) : (
                <MetaItem header="Assignee" content="Nobody was assigned." />
            )} --}}
        </div>
    </div>
    {{-- TODO: Maybe someday?
    <div class="issue-comments">
        <div class="comments-header">Comments</div>
        {issue.comments.nodes.map((comment) => (
            <Comment user={comment.user} content={comment.body} />
        ))}
    </div> --}}
</div>
@endsection

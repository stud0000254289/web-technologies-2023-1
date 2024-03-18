export class Post {
    constructor(postEl, commentsEl, { getPost, getComments, renderPost, renderComment }) {
        this.postEl = postEl;
        this.commentsEl = commentsEl;
        this.getPost = getPost;
        this.getComments = getComments;
        this.renderPost = renderPost;
        this.renderComment = renderComment;
        this.currentPostId = this.getCurrentPostId();
    }

    init() {
        window.onpopstate = this.handlePopState.bind(this);
        this.loadPostAndComments();
    }

    getCurrentPostId() {
        return new URLSearchParams(window.location.search).get('id');
    }

    handlePopState() {
        const postId = this.getCurrentPostId();
        if (postId !== this.currentPostId) {
            this.currentPostId = postId;
            this.loadPostAndComments();
        }
    }

    async loadPostAndComments() {
        try {
            const post = await this.getPost(this.currentPostId);
            this.postEl.innerHTML = this.renderPost(post);
            const comments = await this.getComments(this.currentPostId);
            this.commentsEl.innerHTML = comments.map(this.renderComment).join(' ');
        } catch (error) {
            console.error("Error loading post or comments:", error);
        }
    }
}

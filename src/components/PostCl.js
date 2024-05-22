export class Post {
    #postEl = null;
    #commentsEl = null;
    #getPost = null;
    #getComments = null;
    #renderPost = null;
    #renderComment = null;
    #post = null;

    constructor(postEl, commentsEl, options) {
        const { getPost, getComments, renderPost, renderComment } = options;
        this.#postEl = postEl;
        this.#commentsEl = commentsEl;
        this.#getPost = getPost;
        this.#getComments = getComments;
        this.#renderPost = renderPost;
        this.#renderComment = renderComment;
        this.#post = this.getPostFromURL();
    }

    init() {
        window.onpopstate = () => {
            const url = new URL(window.location.href);
            const post = +url.searchParams.get('id');
            if (post !== this.#post && post > 0) {
                this.setPost(post);
                this.loadPost();
                this.loadComments();
            }
        };
        if (this.#post > 0) {
            this.loadPost();
            this.loadComments();
        } else {
            console.log("Invalid post ID:", this.#post);
            this.#postEl.innerHTML = '<p>Invalid post ID. Please check the URL.</p>';
        }
    }

    getPostFromURL() {
        const url = new URL(window.location.href);
        const post = +url.searchParams.get('id');
        return post;
    }

    setPost(post) {
        this.#post = post;
    }

    async loadPost() {
        try {
            if (this.#post > 0) {
                const post = await this.#getPost(this.#post);
                this.renderPost(post);
            } else {
                console.log("Invalid post ID:", this.#post);
                this.#postEl.innerHTML = '<p>Invalid post ID. Please check the URL.</p>';
            }
        } catch (e) {
            console.log("Error:", e);
            this.#postEl.innerHTML = '<p>Failed to load post. Please try again later.</p>';
        }
    }

    async loadComments() {
        try {
            if (this.#post > 0) {
                const comments = await this.#getComments(this.#post);
                this.renderComments(comments);
            } else {
                console.log("Invalid post ID for comments:", this.#post);
                this.#commentsEl.innerHTML = '<p>Invalid post ID for comments. Please check the URL.</p>';
            }
        } catch (e) {
            console.log("Error:", e);
            this.#commentsEl.innerHTML = '<p>Failed to load comments. Please try again later.</p>';
        }
    }

    renderPost(post) {
        this.#postEl.innerHTML = this.#renderPost(post);
    }

    renderComments(comments) {
        this.#commentsEl.innerHTML = comments.map(this.#renderComment).join(' ');
    }
}

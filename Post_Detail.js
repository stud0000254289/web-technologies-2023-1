// Assuming the necessary imports are already defined at the top of your script
import { Post } from './src/components/PostCl.js';

// Define render functions for a post and comments
const renderPostItem = item => `
    <h2>User ID: ${item.userId}</h2>
    <h2>Post ID: ${item.id}</h2>
    <h2>Post title: ${item.title}</h2>
    <p>Post body: ${item.body}</p>
`;

const renderCommentItem = item => `
    <div class="comment">
        <hr>
        <h3>(Comment ID: ${item.id}) ${item.name}</h3>
        <p>E-mail: ${item.email}</p>
        <p>Body: ${item.body}</p>
    </div>
`;

// Async functions to fetch post and comments data
const getPostItem = async postId => {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching post:", error);
        throw error; // Re-throw to handle in calling context
    }
};

const getCommentItems = async postId => {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching comments:", error);
        throw error; // Re-throw to handle in calling context
    }
};

// Initialization
const init = () => {
    const postEl = document.getElementById('post');
    const commentsEl = document.getElementById('comments');
    const options = { getPost: getPostItem, getComments: getCommentItems, renderPost: renderPostItem, renderComment: renderCommentItem };
    const post = new Post(postEl, commentsEl, options);
    post.init();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

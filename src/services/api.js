import Auth from "./auth.js";
import config from "./config.js";

const api = async (url, options = {}) => {
    const headers = {
        ...(options.headers || {}),
        "Content-Type": "application/json",
    };

    const token = Auth.token;
    if (token) {
        headers["Authorization"] = `Bearer ${token}`;
    }

    const response = await fetch(config.BASE_URL + url, {
        ...options,
        headers,
    });

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }

    return await response.json();
};

export default api;
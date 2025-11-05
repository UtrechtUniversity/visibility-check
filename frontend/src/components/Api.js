import axios from "axios";
import Config from "../helpers/Config";

function Api() {
    const token = localStorage.getItem('vcToken') ?? null;

    const service = axios.create({
        withCredentials: true,
        baseURL: Config('API_URL'),
        timeout: 3000, // Let's say you want to wait at least 3 sec
        headers: {
            'Cache-Control': 'no-cache',
            'Authorization': `Bearer ${token}`
        }
    });

    function getQuestions() {
        const url = "/questions"
        return service.get(url);
    }

    function getUser() {
        const url = "/user";
        return service.get(url);
    }

    function getResults() {
        const url = "/user/score";
        return service.get(url);
    }

    function saveAnswer(payload) {
        const url = "/user/answer";
        return service.post(url, payload);
    }

    return {
        getQuestions, getResults, getUser, saveAnswer
    }
}

export default Api;
console.log('"vendor/ironwoods/FetchHttp.js"'); // HACK:

function getApiToken() {
    const n = document.head.querySelector('meta[name=api-token]');
    return (n) ? n.content : '';
}
function getCsrfToken() {
    const n = document.head.querySelector('meta[name=csrf-token]');
    return (n) ? n.content : '';
}

class FetchHttp // class
{
    async delete(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'DELETE';
        const config = this.getConfigCommon(
            method,
            token,
            api_token,
            {
                'Accept': 'application/json, text-plain, */*',
                'X-Requested-With': 'XMLHttpRequest',
            }
        );

        // body data type must match 'Content-Type' header
        config.body = JSON.stringify(data);

        return this.returnFetchResponse(await fetch(url, config), method);
    }

    async get(url = '', token = null, api_token = null) // void
    {
        const method = 'GET';
        const config = this.getConfigCommon(
            method,
            token,
            api_token,
            {
                'Accept': 'application/json',
            }
        );
        // GET fetch doesn't use config.body

        return this.returnFetchResponse(await fetch(url, config), method, true);
    }

    async post(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'POST';
        const config = this.getConfigCommon(
            method,
            token,
            api_token
        );

        // body data type must match 'Content-Type' header
        config.body = JSON.stringify(data);

        return this.returnFetchResponse(
            await fetch(url, config),
            method,
            true
        );
    }

    async postWithFiles(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'POST';
        const config = this.getConfigCommon(
            method,
            token,
            api_token
        );

        config.body = data;
        // NOTE: NO use config.body = JSON.stringify(data);
        // This remove the formRequest with f.e. the image data
        // body data type must match "Content-Type" header

        // Don't use "Content-Type" to send files
        config.headers = {
            'X-CSRF-Token' : token,
            'Authorization': 'Bearer ' + api_token,
        };

        return this.returnFetchResponse(
            await fetch(url, config),
            method,
            true
        );
    }

    async put(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'PUT';
        const config = this.getConfigCommon(
            method,
            token,
            api_token,
            {
                'X-Requested-With': 'XMLHttpRequest',
            }
        );

        // body data type must match 'Content-Type' header
        config.body = JSON.stringify(data);

        return this.returnFetchResponse(
            await fetch(url, config),
            method,
            true
        );
    }

    async postHTML(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'POST';
        const config = this.getConfigCommon(
            method,
            token,
            api_token,
            {
                'X-Requested-With': 'XMLHttpRequest',
            }
        );

        // body data type must match 'Content-Type' header
        config.body = JSON.stringify(data);

        return this.returnFetchResponse(await fetch(url, config), method);
    }

    async deleteHTML(url, data = {}, token = null, api_token = null) // void
    {
        const method = 'DELETE';
        const config = this.getConfigCommon(
            method,
            token,
            api_token,
            {
                'X-Requested-With': 'XMLHttpRequest',
            }
        );
        // body data type must match 'Content-Type' header
        config.body = JSON.stringify(data);

        return this.returnFetchResponse(await fetch(url, config), method);
    }


    getConfigCommon(method, token = null, api_token = null, custom_headers = {}) // object
    {
        const headers = {
            'Content-Type' : 'application/json',
            'X-CSRF-Token' : token ?? getCsrfToken(),
            'Authorization': 'Bearer ' + (api_token ?? getApiToken()),
        };
        if (custom_headers && custom_headers !== {}) {
            for (const key in custom_headers) {
                headers[key] = custom_headers[key];
            }
        }
        log('HEADERS: ', headers, 'END HEADERS');

        return {
            cache: 'no-cache',    // *default, no-cache, reload, force-cache, only-if-cached

            // https://developer.mozilla.org/es/docs/Web/API/Fetch_API/Using_Fetch#enviar_una_petici%C3%B3n_con_credenciales_incluido
            credentials: 'same-origin', // 'include'|'same-origin'|'omit'
            headers     : headers,
            method      : method, // POST, PUT, DELETE, GET
            // https://developer.mozilla.org/en-US/docs/Web/API/Request/mode
            mode        : 'same-origin', // no-cors, *cors, same-origin
            redirect    : 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        };
    }
    handleErrors(response) // object (promise)
    {
        if (!response.success) {
            warn('FetchHttp@handleErrors => response.statusText: '
                + response.statusText + '\nStatus code: ' + response.status);
            return response;
        }

        if (response.status > 299) {
            warn('FetchHttp@handleErrors => Status code: ' + response.status)
        }

        return response;
    }
    handleJsonResponseError(response)
    {
        const contentType = response.headers.get('Content-Type');
        if (contentType) {
            if (!contentType.includes('application/json')) {
                error('FetchHttp@handleJsonResponseError => NO "application/json" Content-Type', contentType);
            }
        } else {
            error('FetchHttp@handleJsonResponseError => NO Content-Type');
        }
        return response;
    }


    // https://developer.mozilla.org/es/docs/Web/API/Fetch_API/Using_Fetch#objetos_response
    returnFetchResponse(
        response,
        str_method,
        useJson = false // set 'true' to return useful data
    ) // object (promise)
    {
        response.success = (response.success ?? (response.ok ?? false));
        response = this.handleErrors(response);
        if (useJson) {
            response = this.handleJsonResponseError(response);
        }

        const basicResponse = {
            status    : response.status,
            statusText: response.statusText,
            success   : response.success,
        };

        // HACK: trace
        api(
            'FetchHttp@returnFetchResponse() => method: ' + str_method,
            basicResponse
        );
        log('=========== END func debug');

        return (response.ok && useJson)
            ? response.json()
            : basicResponse;
    }
}

/**
 * USE:
 *
 *
    const http = new FetchHttp;
    http.delete(endPoint, {});
 /**/

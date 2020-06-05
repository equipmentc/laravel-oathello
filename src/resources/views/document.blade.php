<div id="oathello"></div>
<script>
class Oathello { constructor(e, s) { this.baseSignUrl = "https://sign.oathello.com", this.baseAdminUrl = "https://admin.oathello.com", this.element = e, s && (this.sessionId = s) } createSession(e, s = "") { let t = this; this.createIframe(`${this.baseSignUrl}/create`), this.handleMessage("frameContentLoaded", function() { document.getElementById("OathelloApp").contentWindow.postMessage({ type: "embeddedCreateSessionStarted", payload: { apiKey: e, notificationsEmail: s } }, t.baseSignUrl) }) } startSession(e) { if (!this.sessionId) return void console.error("No session Id provided"); const s = void 0 !== e ? `${this.baseSignUrl}/${this.sessionId}/${e}` : `${this.baseSignUrl}/${this.sessionId}`; this.createIframe(s) } startDocument(e, s) { if (!e && this.documentIds) { if (this.documentIds[0]) return void console.error("No document available"); e = this.documentIds[0] } const t = void 0 !== s ? `${this.baseSignUrl}/${this.sessionId}/document/${e}/${s}` : `${this.baseSignUrl}/${this.sessionId}/document/${e}`; this.createIframe(t) } adminSignIn(e) { let s = this; this.shouldSignToAdmin = !0, this.createIframe(this.baseAdminUrl), this.handleMessage("frameContentLoaded", function() { if (s.shouldSignToAdmin) { document.getElementById("OathelloApp").contentWindow.postMessage({ type: "admin-signIn", payload: { apiKey: e } }, s.baseAdminUrl) } }) } async getSessionDetails() { const e = this; return new Promise(function(s, t) { const n = new XMLHttpRequest, i = window.btoa(`${e.sessionId}:${e.sessionId}`); n.onload = function() { try { if (n.status >= 200 && n.status < 400) { const t = JSON.parse(this.response); return e.documentIds = t.envelope.documents.map(e => e.fingerprint), s(t) } return s(null) } catch (e) { return console.error(e), s(null) } }, n.open("GET", `${e.baseSignUrl}/api/Session/${e.sessionId}`, !0), n.setRequestHeader("Authorization", `Basic ${i}`), n.send() }) } onSessionCreated(e) { this.handleMessage("sessionCreated", e) } onSessionFinished(e) { this.handleMessage("sessionFinished", e) } onDocumentSigned(e) { this.handleMessage("documentSigned", e) } onAdminSignOut(e) { this.handleMessage("admin-signedOut", e) } handleMessage(e, s) { let t = this; window.addEventListener("message", function(n) { t.isAllowedOrigin(n.origin) && n.data.type === e && (t.processMessage(n), s()) }) } isAllowedOrigin(e) { return [this.baseSignUrl, this.baseAdminUrl].indexOf(e) > -1 } processMessage(e) { switch (e.data.type) { case "sessionCreated": this.sessionId = e.data.payload.sessionId; break; case "admin-signedOut": this.shouldSignToAdmin = !1 } } createIframe(e) { const s = document.createElement("iframe"); s.id = "OathelloApp", s.src = e, this.element.innerHTML = "", this.element.appendChild(s) } }
const element = document.getElementById('oathello');
const oathello = new Oathello(element, '{{ $session }}');
oathello.startDocument('{{ $document }}', '{{ $signer ?? '' }}');
</script>

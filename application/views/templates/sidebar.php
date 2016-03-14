</div>
        <div id="sideBar">
            <div id="pollBar">
                <form>
                    <div id="pollQuestion">Geriausia pasaulio komanda?</div>
                    <div id="pollItems">
                        <input type="radio" name="poll" value="1" /> <label>Real Madrid</label> <br />
                        <input type="radio" name="poll" value="2" /> <label>Barcelona</label> <br />
                        <input type="radio" name="poll" value="3" /> <label>Arsenal</label> <br />
                        <input type="radio" name="poll" value="4" /> <label>Manchester United</label> <br />
                        <input type="radio" name="poll" value="5" /> <label>Juventus</label> <br />
                        <input type="radio" name="poll" value="6" /> <label>Bayern</label> <br />
                    </div>
                    <div id="pollVote">
                        <input type="submit" name="vote" value="Balsuoti" />
                    </div>
                </form>
            </div>
            <hr class="contentContainerHr" />
            <div id="loginBar">
                <form>
                    <input type="text" name="username" placeholder="Vartotojo vardas" /> <br />
                    <input type="password" name="password" placeholder="Slaptažodis"/> <br />
                    <input id="loginSubmit" type="submit" name="vote" value="Prisijungti" /> <br />
                    <a href="/users/remind-password">Slaptažodžio priminimas</a><br />
                    <a href="/users/create"> Užsiregistruoti </a>
                </form>
            </div>
            <hr class="contentContainerHr" />
            <div id="greetBar">
                <div id="greetBarGreet">Sveiki, {username}!</div>
                <a href="/users/change-password">Pasikeisti slaptažodį</a><br />
                <a href="/users/logout">Atsijungti</a><br />
            </div>
        </div>
        <div id="spacer">&nbsp;</div>
    </div>            
</div>
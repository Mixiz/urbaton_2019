CREATE TABLE events
(
    id integer NOT NULL AUTO_INCREMENT,
    out_id integer,
	title text,
    descr text,
	categories text,
    coords point,
    url text,
    start_date bigint,
    end_date bigint,
    CONSTRAINT events_pkey PRIMARY KEY (id)
)
